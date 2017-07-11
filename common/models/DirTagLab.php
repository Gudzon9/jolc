<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dir_tag_lab".
 *
 * @property integer $dir_id
 * @property integer $lab_id
 */
class DirTagLab extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dir_tag_lab';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dir_id', 'lab_id'], 'required'],
            [['dir_id', 'lab_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dir_id' => 'Dir ID',
            'lab_id' => 'Lab ID',
        ];
    }
}
