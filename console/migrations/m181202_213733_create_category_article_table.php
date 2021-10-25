<?php

use common\migration\Migration;


/**
 * Handles the creation of table `category_article`.
 */
class m181202_213733_create_category_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'is_active' => $this->tinyInteger(1)->defaultValue(0),
        ]);

        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'slug' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'body' => $this->text()->notNull(),
            'media_id' => $this->integer()->null(),
            'is_active' => $this->tinyInteger(1)->defaultValue(0),
        ]);


        $this->addForeignKey('fk_article_category','article','category_id','category','id');
        $this->addForeignKey('fk_article_media','article','media_id','media','id');



    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }
}
