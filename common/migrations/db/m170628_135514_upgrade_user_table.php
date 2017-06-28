<?php

use yii\db\Migration;

class m170628_135514_upgrade_user_table extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'branch_id', $this->integer());
        $this->addColumn('user', 'branch_access', $this->integer());

    }

    public function down()
    {
        $this->dropColumn('user', 'branch_id');
        $this->dropColumn('user', 'branch_access');
    }
}
