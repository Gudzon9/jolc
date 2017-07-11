<?php

use yii\db\Migration;

/**
 * Handles the creation of table `mission`.
 */
class m170630_201616_create_dir_tag_lab_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('dir_tag_lab', [
            'dir_id' => $this->integer()->notNull(),
            'lab_id' => $this->integer()->notNull(),
        ]);
        $this->createIndex(
            'idx_lab_id',
            'dir_tag_lab',
            'lab_id'
        );
        $this->createIndex(
            'idx_dir_id',
            'dir_tag_lab',
            'dir_id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex(
            'idx_lab_id',
            'dir_tag_lab'
        );
        $this->dropIndex(
            'idx_dir_id',
            'dir_tag_lab'
        );
        $this->dropTable('dir_tag_lab');
    }
}
