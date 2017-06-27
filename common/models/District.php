<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use common\behaviors\SlogBehavior;

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
                'class' => BlameableBehavior::className(),
                //'value' => function($event) {return Yii::$app->user->id;},
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_by', 'updated_by'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_by'],
                ],
            ],
            'slog' => [
                'class' => SlogBehavior::className(),
                'excludedAttributes' => ['updated_at'],
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
            [['name', 'branch_id'], 'required'],
            [['created_at', 'updated_at', 'created_by','updated_by'], 'safe'],
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
            'created_at' => 'Створено (коли)',
            'updated_at' => 'Змінено (коли)',
            'created_by' => 'Створено (ким)',
            'updated_by' => 'Змінено (ким)',
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
