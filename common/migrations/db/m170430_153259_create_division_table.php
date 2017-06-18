<?php

use yii\db\Migration;

/**
 * Handles the creation of table `division`.
 */
class m170430_153259_create_division_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('division', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'branch_id' => $this->integer()->notNull(),
            'type_div' => $this->integer()->notNull(),
            'type_lab' => $this->integer()->notNull(),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('division');
    }
}
