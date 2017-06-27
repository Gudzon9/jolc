<?php

use yii\db\Migration;

/**
 * Handles the creation of table `mission`.
 */
class m170430_201516_create_mission_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('mission', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'type_lab' => $this->integer()->notNull(),
            'type_direction' => $this->integer()->notNull(),
            'type_when_dir_1' => $this->integer()->notNull(),
            'type_when_dir_2' => $this->integer()->notNull(),
            'material_id' => $this->integer()->notNull(),
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
        $this->dropTable('mission');
    }
}
