<?php

use yii\db\Migration;

/**
 * Handles the creation of table `mission`.
 */
class m170630_201716_create_mat_tag_dir_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('mat_tag_dir', [
            'dir_id' => $this->integer()->notNull(),
            'mat_id' => $this->integer()->notNull(),
        ]);
        $this->createIndex(
            'idx_mat_id',
            'mat_tag_dir',
            'mat_id'
        );
        $this->createIndex(
            'idx_dir_id',
            'mat_tag_dir',
            'dir_id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex(
            'idx_mat_id',
            'mat_tag_dir'
        );
        $this->dropIndex(
            'idx_dir_id',
            'mat_tag_dir'
        );
        $this->dropTable('mat_tag_dir');
    }
}
