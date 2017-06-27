<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "slog".
 *
 * @property integer $id
 * @property integer $created_at
 * @property string $tbl_name
 * @property integer $id_intbl
 * @property string $data_befor
 * @property string $data_after
 */
class Slog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'slog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'tbl_name', 'id_intbl'], 'required'],
            [['created_at', 'id_intbl'], 'integer'],
            [['tbl_name'], 'string', 'max' => 20],
            [['data_befor', 'data_after'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'tbl_name' => 'Tbl Name',
            'id_intbl' => 'Id Intbl',
            'data_befor' => 'Data Befor',
            'data_after' => 'Data After',
        ];
    }
}
