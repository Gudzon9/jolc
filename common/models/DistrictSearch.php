<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\District;

/**
 * DistrictSearch represents the model behind the search form about `common\models\District`.
 */
class DistrictSearch extends District
{
    /**
     * @inheritdoc
     */
    public $created_range;
    public $updated_range;

    public function rules()
    {
        return [
            [['id', 'branch_id'], 'integer'],
            [['name', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            
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
        $query = District::find();

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
            'branch_id' => $this->branch_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);
        /*
        $query->andFilterWhere([
            'like', 
            'FROM_UNIXTIME(updated_at, "%d-%m-%Y")', 
            $this->updated_at
        ]);
        */
        if (!is_null($this->created_range) && 
            strpos($this->created_range, ' - ') !== false ) {
            list($start_date, $end_date) = explode(' - ', $this->created_range);
            $query->andFilterWhere(['between', 'FROM_UNIXTIME(updated_at, "%Y-%m-%d")', $start_date, $end_date]);
        }        
        if (!is_null($this->updated_range) && 
            strpos($this->updated_range, ' - ') !== false ) {
            list($start_date, $end_date) = explode(' - ', $this->updated_range);
            $query->andFilterWhere(['between', 'FROM_UNIXTIME(updated_at, "%Y-%m-%d")', $start_date, $end_date]);
        }        
        return $dataProvider;
    }
}
