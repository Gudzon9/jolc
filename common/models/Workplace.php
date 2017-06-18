<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "workplace".
 *
 * @property integer $id
 * @property string $name
 * @property integer $branch_id
 * @property integer $division_id
 * @property string $created_at
 * @property string $updated_at
 */
class Workplace extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'workplace';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'branch_id', 'division_id', 'created_at'], 'required'],
            [['branch_id', 'division_id'], 'integer'],
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
            'branch_id' => 'Branch ID',
            'division_id' => 'Division ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
