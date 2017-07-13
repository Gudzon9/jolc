<?php

namespace common\models;

use Yii;
use common\commands\AddToTimelineCommand;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use common\behaviors\SlogBehavior;
use common\behaviors\TagsBehavior;
use yii\db\ActiveRecord;
use common\models\DirTagLab;

/**
 * This is the model class for table "direction".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type_lab
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class Direction extends ActiveRecord
{
    public $taglab;


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
            ],
            'crosstab' => [
                'class' => TagsBehavior::className(),
                'CrossTabClassName' => DirTagLab::className(),
                'LeftKeyName' => 'dir_id',
                'RightKeyName' => 'lab_id',
                'TagCont' => 'taglab',
            ]
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'direction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'taglab'], 'required'],
            [['type_lab', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
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
            'taglab' => 'Тип лабораторії',
            'created_at' => 'Створено (коли)',
            'updated_at' => 'Змінено (коли)',
            'created_by' => 'Створено (ким)',
            'updated_by' => 'Змінено (ким)',
        ];
    }
    /*
    public function afterSave($insert, $changedAttributes) {
         parent::afterSave($insert, $changedAttributes);
         
         DirTagLab::deleteAll(['dir_id' => $this->id]);
         foreach ($this->taglab as $item) {
            $dirtag = new DirTagLab();
            $dirtag->dir_id = $this->id;
            $dirtag->lab_id = $item;
            $dirtag->save();             
         }
    }
     */
}
