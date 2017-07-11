<?php

namespace common\models;

use Yii;
use common\commands\AddToTimelineCommand;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use common\behaviors\SlogBehavior;
use yii\db\ActiveRecord;
use common\models\MatTagDir;

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
class Material extends ActiveRecord
{
    public $tagdir;
    
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
        return 'material';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'tagdir'], 'required'],
            [['type_lab', 'type_direction', 'type_when_dir_1', 'type_when_dir_2'], 'integer'],
            [['created_at', 'updated_at', 'created_by','updated_by'], 'safe'],
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
    public function getDirection()
    {
        return $this->hasOne(Direction::className(),['id'=>'type_direction']);
    }
    public function afterSave($insert, $changedAttributes) {
         parent::afterSave($insert, $changedAttributes);
         
         MatTagDir::deleteAll(['mat_id' => $this->id]);
         foreach ($this->tagdir as $item) {
            $mattag = new MatTagDir();
            $mattag->mat_id = $this->id;
            $mattag->dir_id = $item;
            $mattag->save();             
         }
         
         
    }
}
