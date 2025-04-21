<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Client;

/**
 * ClientSearch represents the model behind the search form of `frontend\models\Client`.
 */
class ClientSearch extends Client
{

    public string|null $birth_date_range = null;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['full_name', 'gender', 'birth_date', 'birth_date_range'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {


        $query = Client::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->with('clubs');
        $query->andFilterWhere(['like', 'full_name', $this->full_name]);
        $query->andFilterWhere(['gender' => $this->gender]);

        if($this->birth_date_range) {
            [$from, $to] = explode(' to ', $this->birth_date_range);
            $query->andFilterWhere(['>=', 'birth_date', $from]);
            $query->andFilterWhere(['<=', 'birth_date', $to]);
        }

        $query->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'gender', $this->gender]);

        return $dataProvider;
    }
}
