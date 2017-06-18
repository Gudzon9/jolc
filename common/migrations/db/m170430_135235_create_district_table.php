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
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
        ]);

        $adistrict = [
            'Житомир місто',
            'Житомирський район',
            'Олевський район',
            'Лугинський район',
            'Овруцький район',
            'Новоград-Волинський місто',
            'Новоград-Волинський район',
            'Народицький район',
            'Ємільчинський район',
            'Володарсько - Волинський район',
            'Коростень місто',
            'Коростенський район',
            'Малин місто',
            'Малинський район',
            'Радомишльський район',
            'Червоноармійський район',
            'Баранівський район',
            'Черняхівський район',
            'Коростишівський район',
            'Брусилівський район',
            'Романівський район',
            'Любарський район',
            'Бердичів місто',
            'Бердичівський район',
            'Чуднівський район',
            'Андрушівський район',
            'Попільнянський район',
            'Ружинський район',
        ];    
        foreach ($adistrict as $value) {
            $this->insert('district', ['name' => $value]);
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('district');
    }
}
