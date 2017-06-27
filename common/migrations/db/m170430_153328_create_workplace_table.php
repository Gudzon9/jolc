<?php

use yii\db\Migration;

/**
 * Handles the creation of table `workplace`.
 */
class m170430_153328_create_workplace_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('workplace', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'branch_id' => $this->integer()->notNull(),
            'division_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('workplace');
    }
}
