<?php

use common\migration\Migration;


/**
 * Handles the creation of table `sms_queue`.
 */
class m181127_191959_create_sms_queue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('sms_queue', [
            'id' => $this->primaryKey(),
            'sender_name' => 'varchar(255) DEFAULT NULL',
            'to_numbers' => 'varchar(255) DEFAULT NULL',
            'message' => 'varchar(255) DEFAULT NULL',
            'remote_address' => 'varchar(255) DEFAULT NULL',
            'http_x_forwarded_for' => 'varchar(255) DEFAULT NULL',
            'sent' => 'tinyint(1) DEFAULT \'0\'',
            'sent_at' => 'datetime DEFAULT NULL',
        ]);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('sms_queue');
    }
}
