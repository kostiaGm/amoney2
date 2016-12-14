<?php

namespace frontend\modules\manager\controllers;

use backend\models\User;
use common\models\CollateralTypes;
use common\models\Transactions;
use common\models\TransactionsSearchByAgreement;
use Yii;
use common\models\Agreement;
use common\models\AgreementSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AgreementController implements the CRUD actions for Agreement model.
 */
class AgreementController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Agreement models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AgreementSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Agreement model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        $searchModel = new TransactionsSearchByAgreement();
        $searchModel->setAgreementId($id);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        $transactionModel = new Transactions();

        $transactionModel->agreementId = $id;

        $model = $this->findModel($id);

        $user = User::findOne($model->uid);
        $collateralType = CollateralTypes::findOne($model->collateralTypesId);

        return $this->render('view', [
            'collateralType' => $collateralType->name,
            'model' => $model,
            'user' => $user,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'transactionModel' => $transactionModel
        ]);
    }

    /**
     * Creates a new Agreement model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Agreement();
        $model->name = 'Договор № '.time();
        $model->periodDays = Yii::$app->params['agreement']['defaultPeriod'];
        $model->procentOfOneDay = Yii::$app->params['agreement']['defaultProcent'];

        $isLoad = $model->load(Yii::$app->request->post());

        if ($isLoad) {
            $id = $this->newCollateralType($model);
            if ($id > 0) {
                $model->collateralTypesId = $id;
            }
            $model->createdAt = date('Y-m-d H:i:s');
            /**
             * Дата возврата. К дате создание добавляется количество дней
             */
            $model->returnDate = date('Y-m-d H:i:s',  ((int) strtotime($model->createdAt ) + ( (int) $model->periodDays * 86400 )));
            /**
             * Сумма процентов за один день.
             */
            $sumProcentOfOneDay = $model->sum / 100 * $model->procentOfOneDay;
            /**
             * Сумма процентов за весь период
             */
            $model->actualAmountOfInterest = $sumProcentOfOneDay * $model->periodDays ;

            /**
             * Фактическиий срок кредита. Временно ставим 0
             */
            $model->actualTermOfTheLoan = 0;

            /**
             * Общая задолжность. Сумма + процент да весь период
             */
            $model->totalDebt = $model->sum + $model->actualAmountOfInterest;

            /**
             * Фактическое погашение. Ставим 0
             */
            $model->actualDebtRepayment = 0;

            /**
             * Задолжность
             */
            $model->debt = $model->totalDebt - $model->actualDebtRepayment;

            /**
             * Общий доход
             */

            $model->actualIncome = $model->actualDebtRepayment;

            /**
             * Фактический доход
             */

            $model->actualProfit = $model->actualIncome - $model->sum;

        }

        //newCollateralType

        if ($isLoad && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Agreement model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $isLoad = $model->load(Yii::$app->request->post());

        if ($isLoad) {
            $id = $this->newCollateralType($model);
            if ($id > 0) {
                $model->collateralTypesId = $id;
            }

            $model->updatedAt = date('Y-m-d H:i:s');
        }

        if ($isLoad && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Agreement model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Agreement model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Agreement the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Agreement::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function newCollateralType($model)
    {
        if (!empty($model->newCollateralType)) {
            $model1 = new CollateralTypes();
            $model1->name = $model->newCollateralType;

            if ($model1->save()) {
                return $model1->id;
            }
        }

        return 0;
    }
}
