<?php

use yii\db\Migration;

/**
 * Handles the creation of table `material`.
 */
class m170430_201146_create_material_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('material', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'type_lab' => $this->integer()->notNull(),
            'type_direction' => $this->integer()->notNull(),
            'type_when_dir_1' => $this->integer()->notNull(),
            'type_when_dir_2' => $this->integer()->notNull(),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('material');
    }
}
