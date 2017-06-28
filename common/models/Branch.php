<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use common\behaviors\SlogBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
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
    const BRANCH_MASTER = 1;
    const BRANCH_SLAVE = 2;
    
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
        return 'branch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','type'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['type'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at', 'created_by','updated_by'], 'safe'],
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
            'type' => 'Тип',
            'description' => 'Прімітка',
            'created_at' => 'Створено (коли)',
            'updated_at' => 'Змінено (коли)',
            'created_by' => 'Створено (ким)',
            'updated_by' => 'Змінено (ким)',
        ];
    }

}
