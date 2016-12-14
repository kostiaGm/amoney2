<?php

namespace frontend\modules\manager\controllers;

use common\models\TransactionsSearchByAgreement;
use common\models\TransactionsSearchByUser;
use Yii;
use backend\models\User;
use frontend\modules\manager\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UsersController implements the CRUD actions for User model.
 */
class UsersController extends ManagerController
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionModal()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('modal', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'isModal' => $this->isModalLayout
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        $searchModel = new TransactionsSearchByUser();
        $searchModel->setUid($id);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);




        return $this->render('view', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $this->findModel($id),
            'isModal' => $this->isModalLayout
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $isLoad = $model->load(Yii::$app->request->post());

        if ($isLoad) {
            $model->role = 'User';
            $model->status = 10;
            $model->created_at = time();
        }

        if ($this->loadPhoto($model)) {

        }


        if ($isLoad && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            return $this->render('create', [
                'model' => $model,
                'isModal' => $this->isModalLayout
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $fileName = $model->photo;
        $isLoad = $model->load(Yii::$app->request->post());

        if ($this->loadPhoto($model)) {

        }

        if ($isLoad) {
            $model->updated_at = time();
            if (empty($model->photo) && !empty($fileName)) {
                $model->photo = $fileName;
            }
            $model->role = 'User';
            $model->status = 10;
        }

        if ($isLoad && $model->save()) {


            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'isModal' => $this->isModalLayout
            ]);
        }
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function loadPhoto($model)
    {
        if (Yii::$app->request->isPost) {
            $model->photo = UploadedFile::getInstance($model, 'photo');
            if ($model->upload()) {
                // file is uploaded successfully
                return true;
            }
        }
    }

    public function actionGet($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $query = User::find()->where('id=:id', [':id' => $id]);
        $model = $query->one();
        $model->photo = $model->getPhoto();
        return $model;
    }
}
