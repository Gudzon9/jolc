<?php

use yii\db\Migration;

/**
 * Handles the creation of table `district`.
 */
class m170430_135235_create_district_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('district', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'branch_id' =>  $this->integer()->notNull(),
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
        $this->dropTable('district');
    }
}
