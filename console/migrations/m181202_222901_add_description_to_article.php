<?php

use common\migration\Migration;

/**
* Class m181202_222901_add_description_to_article
*/
class m181202_222901_add_description_to_article extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {

        $this->addColumn('article','description',$this->string(500)->after('title'));
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        echo "m181202_222901_add_description_to_article cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181202_222901_add_description_to_article cannot be reverted.\n";

        return false;
    }
*/
}
