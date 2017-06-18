<?php
namespace common\models;

use common\commands\AddToTimelineCommand;
use yii\behaviors\TimestampBehavior;
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
    const EVENT_AFTER_CHANGE = 'afterChange';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'division';
    }
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'branch_id', 'type_div', 'type_lab', 'created_at'], 'required'],
            [['branch_id', 'type_div', 'type_lab'], 'integer'],
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
            'type_div' => 'Type Div',
            'type_lab' => 'Type Lab',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

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
    
}
