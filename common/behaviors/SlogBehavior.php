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
    public $excludedAttributes = [];

    public function events()
    {
        return [
                    ActiveRecord::EVENT_AFTER_INSERT => 'save2log',
                    ActiveRecord::EVENT_AFTER_UPDATE => 'save2log',
        ];
    }

    public function save2log(Event $event)
    {
        $owner = $this->owner;
        $changedAttributes = $event->changedAttributes;
        $diffb = [];
        $diffa = [];
        foreach ($changedAttributes as $attrName => $attrVal) {
                $newAttrVal = $owner->getAttribute($attrName);
                if ($newAttrVal != $attrVal) {
                    if ($attrVal == '') {
                        $attrVal = 'null';
                    }
                    if ($newAttrVal == '') {
                        $newAttrVal = 'null';
                    }
                    $diffb[$attrName] = $attrVal;
                    $diffa[$attrName] = $newAttrVal;
                }
        }
        $diffb = $this->_applyExclude($diffb);
        $diffa = $this->_applyExclude($diffa);
        if ($diffb) {
            $diffb = $this->_setLabels($diffb);
            $diffa = $this->_setLabels($diffa);
        
            $model = new Slog();
            $model->created_at = time();
            $model->tbl_name = $this->owner->tableName();
            $model->id_intbl = $this->owner->id;
            $model->data_befor = json_encode($diffb, JSON_UNESCAPED_UNICODE);
            $model->data_after = json_encode($diffa, JSON_UNESCAPED_UNICODE);
            return $model->save(false);
        }
    }
    private function _applyExclude(array $diff)
    {
        foreach ($this->excludedAttributes as $attr) {
             unset($diff[$attr]);
        }
        return $diff;
    }
    private function _setLabels(array $diff)
    {
        $owner = $this->owner;
        foreach ($diff as $attr => $msg) {
            unset($diff[$attr]);
            $diff[$owner->getAttributeLabel($attr)] = $msg;
        }
        return $diff;
    }    
}
