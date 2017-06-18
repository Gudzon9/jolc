<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
/**
 * This is the model class for table "district".
 *
 * @property integer $id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 *
 * @property BranchDistrict[] $branchDistricts
 * @property Branch[] $branches
 */
class District extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'timestamp'=> [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
                // 'value' => new Expression('NOW()'),
            ],
            'user_id' => [
                'class' => AttributeBehavior::className(),
                'value' => function($event) {return Yii::$app->user->id;},
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['user_id'],
                ],
            ]
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'district';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'created_at','branch_id'], 'required'],
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
            'name' => 'Назва',
            'branch_id' => 'Відділення',
            'created_at' => 'Створено',
            'updated_at' => 'Змінено',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(),['id'=>'branch_id']);
    }
}
