<?php

use common\migration\Migration;

/**
* Class m181202_214307_add_slug_to_user
*/
class m181202_214307_add_slug_to_user extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {

        $this->addColumn('user','slug',$this->string()->null()->after('user_type_id'));
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        echo "m181202_214307_add_slug_to_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181202_214307_add_slug_to_user cannot be reverted.\n";

        return false;
    }
*/
}
