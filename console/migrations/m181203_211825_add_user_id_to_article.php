<?php

use common\migration\Migration;

/**
* Class m181203_211825_add_user_id_to_article
*/
class m181203_211825_add_user_id_to_article extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->addColumn('article','user_id',$this->integer()->after('category_id')->null());

        $this->addForeignKey('fk_article_user_id','article','user_id','user','id');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        echo "m181203_211825_add_user_id_to_article cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181203_211825_add_user_id_to_article cannot be reverted.\n";

        return false;
    }
*/
}
