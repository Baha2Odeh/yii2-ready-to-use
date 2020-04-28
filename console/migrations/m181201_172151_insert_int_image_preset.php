<?php

use common\migration\Migration;

/**
* Class m181201_172151_insert_int_image_preset
*/
class m181201_172151_insert_int_image_preset extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {

        $image = new \common\models\ImagePreset();
        $image->name = 'thumb';
        $image->width = 100;
        $image->height = 100;
        $image->save();

        $image = new \common\models\ImagePreset();
        $image->name = 'medium';
        $image->width = 250;
        $image->height = 250;
        $image->save();

        $image = new \common\models\ImagePreset();
        $image->name = 'large';
        $image->width = 500;
        $image->height = 500;
        $image->save();



    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        echo "m181201_172151_insert_int_image_preset cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181201_172151_insert_int_image_preset cannot be reverted.\n";

        return false;
    }
*/
}
