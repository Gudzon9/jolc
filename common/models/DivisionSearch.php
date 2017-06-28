<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Division;
use common\models\User;

/**
 * DivisionSearch represents the model behind the search form about `common\models\Division`.
 */
class DivisionSearch extends Division
{
    /**
     * @inheritdoc
     */
    public $created_range;
    public $updated_range;

    public function rules()
    {
        return [
            [['id', 'branch_id', 'type_div', 'type_lab'], 'integer'],
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
        $query = Division::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if(Yii::$app->user->identity->branch_access == User::BRANCH_OWN) {
            $query->andFilterWhere(['branch_id' => Yii::$app->user->identity->branch_id, ]);
        }
        
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
            'type_div' => $this->type_div,
            'type_lab' => $this->type_lab,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

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
