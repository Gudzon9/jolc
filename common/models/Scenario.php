<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "scenario".
 *
 * @property integer $id
 * @property string $name
 * @property integer $workplace_id
 * @property integer $type
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class Scenario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scenario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'workplace_id', 'type', 'status', 'created_at'], 'required'],
            [['workplace_id', 'type', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'workplace_id' => 'Workplace ID',
            'type' => 'Type',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
