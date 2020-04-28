<?php

use common\migration\Migration;

/**
* Class m181202_220330_add_slug_to_category_table
*/
class m181202_220330_add_slug_to_category_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->addColumn('category','slug',$this->string()->notNull()->after('id'));
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        echo "m181202_220330_add_slug_to_category_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181202_220330_add_slug_to_category_table cannot be reverted.\n";

        return false;
    }
*/
}
