<?php

use yii\db\Migration;

/**
 * Handles the creation of table `shop_categories`.
 */
class m180106_132434_create_shop_categories_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci';

        $this->createTable('{{%shop_categories}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'body' => $this->text(),
            'slug' => $this->string(),
            'title' => $this->string(),
            'description' => $this->string(),
            'keywords' => $this->string(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('{{%idx-shop_categories-slug}}', '{{%shop_categories}}', 'slug', true);

        $this->insert('{{%shop_categories}}', [
            'id' => 1,
            'name' => '',
            'body' => '',
            'slug' => 'root',
            'title' => '',
            'description' => '',
            'keywords' => '',
            'lft' => 1,
            'rgt' => 2,
            'depth' => 0,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%shop_categories}}');
    }
}
