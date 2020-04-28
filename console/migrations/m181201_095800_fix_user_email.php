<?php

use common\migration\Migration;

/**
* Class m181201_095800_fix_user_email
*/
class m181201_095800_fix_user_email extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->update('user',['email'=>null],['email'=>'']);
        $this->alterColumn('user','email',$this->string()->null());
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        echo "m181201_095800_fix_user_email cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181201_095800_fix_user_email cannot be reverted.\n";

        return false;
    }
*/
}
