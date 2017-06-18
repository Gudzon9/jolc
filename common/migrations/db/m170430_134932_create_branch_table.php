<?php

use yii\db\Migration;

/**
 * Handles the creation of table `branch`.
 */
class m170430_134932_create_branch_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('branch', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'type' => $this->integer()->notNull()->defaultValue(2),
            'description' => $this->text(),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
        ]);
        $abranch = [
            'Житомирський міськрайонний відділ',
            'Андрушівський міжрайонний відділ',
            'Бердичівський районний відділ',
            'Коростенський міжрайонний відділ',
            'Коростишівський міжрайонний відділ',
            'Малинський міжрайонний відділ',
            'Новоград-Волинський міжрайонний відділ',
            'Овруцький міжрайонний відділ',
            'Олевський міжрайонний відділ',
            'Романівський міжрайонний відділ',
        ];    
        foreach ($abranch as $value) {
            $this->insert('branch', ['name' => $value]);
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('branch');
    }
}
