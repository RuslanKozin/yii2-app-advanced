<?php

use yii\db\Schema;
use yii\db\Migration;

class m160808_124339_create_asto_tables extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%star}}',
            [
                'id' => Schema::TYPE_PK,
                'name' => Schema::TYPE_STRING . ' NOT NULL',
            ],
            $tableOptions
        );

        $this->createTable(
            '{{%planet}}',
            [
                'id' => Schema::TYPE_PK,
                'name' => Schema::TYPE_STRING . ' NOT NULL',
                'star_id' => Schema::TYPE_INTEGER . ' NOT NULL',
                'FOREIGN KEY(star_id) REFERENCES '
                . $this->db->quoteTableName('{{%star}}') . '(id) ON UPDATE CASCADE ON DELETE CASCADE'
            ],
            $tableOptions
        );

        $this->createTable(
            '{{%satellite}}',
            [
                'id' => Schema::TYPE_PK,
                'name' => Schema::TYPE_STRING . ' NOT NULL',
                'planet_id' => Schema::TYPE_INTEGER . ' NOT NULL',
                'FOREIGN KEY(planet_id) REFERENCES '
                . $this->db->quoteTableName('{{%planet}}') . '(id) ON UPDATE CASCADE ON DELETE CASCADE'
            ],
            $tableOptions
        );
    }

    public function down()
    {
        $this->dropTable('{{%satellite}}');
        $this->dropTable('{{%planet}}');
        $this->dropTable('{{%star}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
