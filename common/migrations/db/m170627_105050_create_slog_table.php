<?php

use yii\db\Migration;

/**
 * Handles the creation of table `slog`.
 */
class m170627_105050_create_slog_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('slog', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'tbl_name' => $this->string(20)->notNull(),
            'id_intbl' => $this->integer()->notNull(),
            'data_befor' => $this->string(200),
            'data_after' => $this->string(200),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('slog');
    }
}
