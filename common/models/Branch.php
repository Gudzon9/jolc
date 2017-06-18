<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "branch".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 *
 * @property BranchDistrict[] $branchDistricts
 * @property District[] $districts
 */
class Branch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'branch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'created_at'], 'required'],
            [['type'], 'integer'],
            [['description'], 'string'],
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
            'type' => 'Type',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistricts()
    {
        return $this->hasMany(District::className(), ['id' => 'district_id']);
    }
}
