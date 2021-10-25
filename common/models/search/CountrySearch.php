<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Country;

/**
 * CountrySearch represents the model behind the search form of `common\models\Country`.
 */
class CountrySearch extends Country
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'numcode', 'dialing_code_1', 'dialing_code_2', 'dialing_code_3', 'degree_language_id', 'weight', 'created_by', 'updated_by', 'is_deleted', 'deleted_by'], 'integer'],
            [['iso', 'name', 'printable_name', 'iso3', 'arabic_name', 'created_at', 'updated_at', 'deleted_at', 'ip_address', 'user_agent'], 'safe'],
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
        $query = Country::find();

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
            'numcode' => $this->numcode,
            'dialing_code_1' => $this->dialing_code_1,
            'dialing_code_2' => $this->dialing_code_2,
            'dialing_code_3' => $this->dialing_code_3,
            'degree_language_id' => $this->degree_language_id,
            'weight' => $this->weight,
//            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
//            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'is_deleted' => $this->is_deleted,
//            'deleted_at' => $this->deleted_at,
            'deleted_by' => $this->deleted_by,
        ]);

        $query->andFilterWhere(['like', 'iso', $this->iso])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'printable_name', $this->printable_name])
            ->andFilterWhere(['like', 'iso3', $this->iso3])
            ->andFilterWhere(['like', 'arabic_name', $this->arabic_name])
            ->andFilterWhere(['like', 'ip_address', $this->ip_address])
            ->andFilterWhere(['like', 'user_agent', $this->user_agent])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'updated_at', $this->updated_at])
        ;

        return $dataProvider;
    }
}
