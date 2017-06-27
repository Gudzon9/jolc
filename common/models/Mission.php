<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mission".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type_lab
 * @property integer $type_direction
 * @property integer $type_when_dir_1
 * @property integer $type_when_dir_2
 * @property integer $material_id
 * @property string $created_at
 * @property string $updated_at
 */
class Mission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mission';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type_lab', 'type_direction', 'type_when_dir_1', 'type_when_dir_2', 'material_id', 'created_at'], 'required'],
            [['type_lab', 'type_direction', 'type_when_dir_1', 'type_when_dir_2', 'material_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
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
            'type_lab' => 'Type Lab',
            'type_direction' => 'Type Direction',
            'type_when_dir_1' => 'Type When Dir 1',
            'type_when_dir_2' => 'Type When Dir 2',
            'material_id' => 'Material ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
