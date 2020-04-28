<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Institution;

/**
 * InstitutionSearch represents the model behind the search form of `common\models\Institution`.
 */
class InstitutionSearch extends Institution
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'country_id', 'ivy_league', 'global_rank', 'language_id', 'created_by', 'updated_by', 'is_deleted', 'deleted_by'], 'integer'],
            [['name', 'alternative_names', 'type_id', 'ranking_id', 'adder_type_id', 'sector', 'name_ar', 'created_at', 'updated_at', 'deleted_at', 'ip_address', 'user_agent'], 'safe'],
        ];
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
        $query = Institution::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
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
            'country_id' => $this->country_id,
            'ivy_league' => $this->ivy_league,
            'global_rank' => $this->global_rank,
            'language_id' => $this->language_id,
//            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
//            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'is_deleted' => $this->is_deleted,
            'deleted_at' => $this->deleted_at,
            'deleted_by' => $this->deleted_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'alternative_names', $this->alternative_names])
            ->andFilterWhere(['like', 'type_id', $this->type_id])
            ->andFilterWhere(['like', 'ranking_id', $this->ranking_id])
            ->andFilterWhere(['like', 'adder_type_id', $this->adder_type_id])
            ->andFilterWhere(['like', 'sector', $this->sector])
            ->andFilterWhere(['like', 'name_ar', $this->name_ar])
            ->andFilterWhere(['like', 'ip_address', $this->ip_address])
            ->andFilterWhere(['like', 'user_agent', $this->user_agent])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'updated_at', $this->updated_at]);;

        return $dataProvider;
    }
}
