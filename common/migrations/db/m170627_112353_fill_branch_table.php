<?php

use yii\db\Migration;

class m170627_112353_fill_branch_table extends Migration
{
    public function up()
    {
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
        $currt = time();
        foreach ($abranch as $value) {
            $this->insert('branch', [
                'name' => $value,
                'created_at' => $currt,
                'updated_at' => $currt,
                'created_by' => 1,
                'updated_by' => 1,
                ]);
        }

    }

    public function down()
    {
        return false;
    }
}
