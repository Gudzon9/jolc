<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "material".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type_lab
 * @property integer $type_direction
 * @property integer $type_when_dir_1
 * @property integer $type_when_dir_2
 * @property string $created_at
 * @property string $updated_at
 */
class Material extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'material';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type_lab', 'type_direction', 'type_when_dir_1', 'type_when_dir_2', 'created_at'], 'required'],
            [['type_lab', 'type_direction', 'type_when_dir_1', 'type_when_dir_2'], 'integer'],
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
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
