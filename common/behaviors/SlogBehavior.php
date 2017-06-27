<?php

namespace common\behaviors;

use yii\base\Behavior;
 use yii\base\Event;
use yii\db\ActiveRecord;
//use common\commands\AddToSlogCommand;
use common\models\Slog;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class SlogBehavior extends Behavior
{
    public function events()
    {
        return [
                    ActiveRecord::EVENT_AFTER_INSERT => 'save2log',
                    ActiveRecord::EVENT_AFTER_UPDATE => 'save2log',
        ];
    }

    public function save2log(Event $event)
    {
        /*
        Yii::$app->commandBus->handle(new AddToSlogCommand([
            'created_at' => time(),
            'tbl_name' => $this->owner->tableName(),
            'id_intbl' => $this->owner->id,
            'data_befor' => json_encode($this->owner, JSON_UNESCAPED_UNICODE),
        ]));
         * 
         */
        $model = new Slog();
        $model->created_at = time();
        $model->tbl_name = $this->owner->tableName();
        $model->id_intbl = $this->owner->id;
        $model->data_befor = json_encode($event->changedAttributes, JSON_UNESCAPED_UNICODE);
        return $model->save(false);
        
    }
}
