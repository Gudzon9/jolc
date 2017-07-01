<?php
namespace common\models;

use common\commands\AddToTimelineCommand;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use common\behaviors\SlogBehavior;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "division".
 *
 * @property integer $id
 * @property string $name
 * @property integer $branch_id
 * @property integer $type_div
 * @property integer $type_lab
 * @property string $created_at
 * @property string $updated_at
 */
class Division extends \yii\db\ActiveRecord
{
    const DIVISION_TYPE_ADM = 1;
    const DIVISION_TYPE_ORG = 2;
    const DIVISION_TYPE_LAB = 3;
    /**
     * @inheritdoc
     */
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
    public static function tableName()
    {
        return 'division';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'branch_id', 'type_div', 'type_lab'], 'required'],
            [['branch_id', 'type_div', 'type_lab'], 'integer'],
            [['created_at', 'updated_at', 'created_by','updated_by'], 'safe'],
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
            'name' => 'Назва',
            'branch_id' => 'Відділення',
            'type_div' => 'Тип підрозділу',
            'type_lab' => 'Тип лабораторії',
            'created_at' => 'Створено (коли)',
            'updated_at' => 'Змінено (коли)',
            'created_by' => 'Створено (ким)',
            'updated_by' => 'Змінено (ким)',
        ];
    }

    public function getBranch()
    {
        return $this->hasOne(Branch::className(),['id'=>'branch_id']);
    }
    public static function divtypes()
    {
       return [
            self::DIVISION_TYPE_ADM => 'Адміністрація',
            self::DIVISION_TYPE_ORG => 'Орг.відділи',
            self::DIVISION_TYPE_LAB => 'Лабораторії',
        ];
    }

/*    
        public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        //$this->trigger(self::EVENT_AFTER_CHANGE);
        Yii::$app->commandBus->handle(new AddToTimelineCommand([
            'category' => 'division',
            'event' => 'change',
            'data' => [
                'name' => $this->name,
                'branch_id' => $this->branch_id,
            ]
        ]));
    }
  

    public function afterChange()
    {
        Yii::$app->commandBus->handle(new AddToTimelineCommand([
            'category' => 'division',
            'event' => 'change',
            'data' => [
                'name' => $this->name,
                'branch_id' => $this->branch_id,
            ]
        ]));
    }
 */    
}
