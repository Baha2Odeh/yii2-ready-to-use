<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%institution}}`.
 */
class m100130_214936_create_table_institution extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%institution}}', [

            'id' => $this->primaryKey()->notNull(),
            'name' => $this->string(255)->notNull(),
            'alternative_names' => $this->text()->notNull(),
            'type_id' => $this->string()->notNull()->defaultValue('Other'),
            'country_id' => $this->integer(11)->notNull(),
            'ranking_id' => $this->string()->notNull()->defaultValue('Others'),
            'ivy_league' => $this->integer(11)->notNull(),
            'global_rank' => $this->integer(11),
            'language_id' => $this->integer(11),
            'adder_type_id' => $this->string(),
            'sector' => $this->string(),
            'name_ar' => $this->string(255)->notNull(),
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
 

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {


        $this->dropTable('{{%institution}}');
    }
}
