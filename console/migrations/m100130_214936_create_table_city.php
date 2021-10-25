<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%city}}`.
 */
class m100130_214936_create_table_city extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%city}}', [

            'id' => $this->primaryKey()->notNull(),
            'name' => $this->string(255)->notNull(),
            'country_id' => $this->integer(11)->notNull(),
            'arabic_name' => $this->string(255),
            'alternate_names' => $this->text(),
            'position' => $this->integer(11),
            'province_id' => $this->integer(11),
            'created_at' => 'datetime NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'created_by' => $this->integer(11),
            'updated_at' =>'datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP',
            'updated_by' => $this->integer(11),
            'is_deleted' => $this->tinyInteger(1)->notNull(),
            'deleted_at' => $this->datetime(),
            'deleted_by' => $this->integer(11),
            'ip_address' => $this->string(40),
            'user_agent' => $this->string(255),

        ]);
 
        // creates index for column `country_id`
        $this->createIndex(
            'city_ibfk_1',
            '{{%city}}',
            'country_id'
        );

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {

    }
}
