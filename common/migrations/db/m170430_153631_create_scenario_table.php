<?php

use yii\db\Migration;

/**
 * Handles the creation of table `scenario`.
 */
class m170430_153631_create_scenario_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('scenario', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'workplace_id' => $this->integer()->notNull(),
            'type' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
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
        $this->dropTable('scenario');
    }
}
