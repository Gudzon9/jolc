<?php

use yii\db\Migration;

/**
 * Handles the creation of table `forms`.
 */
class m170430_194839_create_forms_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('forms', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'type' => $this->integer()->notNull(),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('forms');
    }
}
