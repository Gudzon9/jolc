<?php

use yii\db\Migration;

/**
 * Handles the creation of table `mission`.
 */
class m170630_201516_create_direction_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('direction', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'type_lab' => $this->integer()->notNull(),
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
        $this->dropTable('direction');
    }
}
