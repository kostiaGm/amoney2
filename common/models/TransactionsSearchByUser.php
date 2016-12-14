<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Transactions;

/**
 * TransactionsSearch represents the model behind the search form about `common\models\Transactions`.
 */
class TransactionsSearchByUser extends Transactions
{

    private $uid;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'agreementId'], 'integer'],
            [['type', 'createdAt'], 'safe'],
            [['sum'], 'number'],
        ];
    }

    public function setUid($id)
    {
        $this->uid = $id;
    }


    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Transactions::find();

        // add conditions that should always apply here

        $query->where("uid=:uid", [
            ":uid" => $this->uid
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);



        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'agreementId' => $this->agreementId,
            'createdAt' => $this->createdAt,
            'sum' => $this->sum,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
