<?php
namespace common\behaviors;

use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;

class TagsBehavior extends Behavior
{
    public $CrossTabClassName = '';
    public $LeftKeyName = '';
    public $RightKeyName = '';
    public $TagCont = '';


    public function events()
    {
        return [
                    ActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
                    ActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',
        ];
    }

    public function afterSave(Event $event) {
        $owner = $this->owner;
        $ttc = $this->TagCont;
        $lkn = $this->LeftKeyName;
        $rkn = $this->RightKeyName;
        $this->CrossTabClassName::deleteAll([$this->LeftKeyName => $owner->id]);
        foreach ($owner->$ttc as $item) {
            $ctobj = new $this->CrossTabClassName();
            $ctobj->$lkn = $owner->id;
            $ctobj->$rkn = $item;
            $ctobj->save();             
        }
    }
}
