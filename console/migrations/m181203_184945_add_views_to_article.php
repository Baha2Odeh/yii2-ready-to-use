<?php

use common\migration\Migration;

/**
* Class m181203_184945_add_views_to_article
*/
class m181203_184945_add_views_to_article extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->addColumn('article','views',$this->integer()->defaultValue(0)->after('is_active'));
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        echo "m181203_184945_add_views_to_article cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181203_184945_add_views_to_article cannot be reverted.\n";

        return false;
    }
*/
}
