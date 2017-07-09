<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Direction;

/**
 * DirectionSearch represents the model behind the search form about `common\models\Direction`.
 */
class DirectionSearch extends Direction
{
    public $created_range;
    public $updated_range;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type_lab', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'safe'],
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
        $query = Direction::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'type_lab' => $this->type_lab,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
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
