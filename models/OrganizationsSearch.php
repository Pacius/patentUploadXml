<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Organizations;

/**
 * OrganizationsSearch represents the model behind the search form of `app\models\Organizations`.
 */
class OrganizationsSearch extends Organizations
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['unn', 'okno', 'name', 'full_name', 'form_realt', 'fio_director', 'phone', 'email', 'url', 'index'], 'safe'],
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
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Organizations::find();

        // add conditions that should always apply here

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
        ]);

        $query->andFilterWhere(['like', 'unn', $this->unn])
            ->andFilterWhere(['like', 'okno', $this->okno])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'form_realt', $this->form_realt])
            ->andFilterWhere(['like', 'fio_director', $this->fio_director])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'index', $this->index]);

        return $dataProvider;
    }
}
