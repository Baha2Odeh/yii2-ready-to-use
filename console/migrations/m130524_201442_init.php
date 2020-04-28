<?php

use common\Migration\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
            /// country , city , institute
        $this->createTable('{{%user_type}}',[
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'is_active' => $this->smallInteger()->notNull()->defaultValue(0),
        ]);


        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'user_type_id' => $this->integer(),
            'first_name'=>$this->string()->null(),
            'last_name'=>$this->string()->null(),
            'gender'=>'ENUM("male","female") DEFAULT NULL',
            'dob' => $this->date(),
            // login data
            'phone_number'=> $this->string()->null()->unique(),
            'email' => $this->string()->null()->unique(),

            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),

            'access_token'=>$this->string(80)->null()->unique(), // for api
            'country_id' => $this->integer()->null(),
            'city_id'=>$this->integer()->null(),
            'is_active' => $this->smallInteger()->notNull()->defaultValue(0),
            'media_id'=>$this->integer()->null(),
        ]);



        $this->createTable('image_preset', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'width' => $this->integer()->notNull(),
            'height' => $this->integer()->notNull()
        ]);

        $this->createTable('media',[
            'id'=>$this->primaryKey(),
            'type'=>'enum(\'image\',\'video\') NOT NULL default \'image\'',
            'name'=>$this->text()->null(),
            'path'=>$this->text()->notNull(),
            'extension'=>$this->text()->notNull(),
            'size'=>$this->double()->null(),
            'is_active'=>$this->smallInteger()->defaultValue(1),
        ]);


        $this->createTable('email_queue',[
            'id' => $this->primaryKey(),
            'from_address' => $this->string()->null(),
            'to_address' => $this->string()->null(),
            'cc_address' => $this->string()->null(),
            'bcc_address' => $this->string()->null(),
            'reply_to_address' => $this->string()->null(),
            'subject' => $this->string()->null(),
            'message' => $this->text(),
            'remote_address' => $this->string()->null(),
            'http_x_forwarded_for' => $this->string()->null(),
            'mail_content_type' => $this->string()->null(),
            'mail_charset' => $this->string()->null(),
            'return_path' => $this->string()->null(),
            'priority' => $this->tinyInteger(1)->defaultValue(0),
            'attachment_pathes' => $this->text()->null(),
            'sent' => $this->tinyInteger(1)->defaultValue(0),
            'sent_at' => $this->dateTime()->null(),
            'language_code' => $this->string(5)->defaultValue('en'),
        ]);











        $this->addForeignKey('fk_user_user_type_id','user','user_type_id','user_type','id');
        $this->addForeignKey('fk_user_country_id','user','country_id','country','id');
        $this->addForeignKey('fk_user_city_id','user','city_id','city','id');

        $this->addForeignKey('fk_user_media_id','user','media_id','media','id');








    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
