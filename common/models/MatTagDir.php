<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mat_tag_dir".
 *
 * @property integer $dir_id
 * @property integer $mat_id
 */
class MatTagDir extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mat_tag_dir';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dir_id', 'mat_id'], 'required'],
            [['dir_id', 'mat_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dir_id' => 'Dir ID',
            'mat_id' => 'Mat ID',
        ];
    }
}
