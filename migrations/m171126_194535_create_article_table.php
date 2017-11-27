<?php

use yii\db\Migration;

/**
 * Handles the creation of table `Article`.
 */
class m171126_194535_create_article_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%articles}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'body' => $this->text(),
            'slug' => $this->string(),
            'status' => $this->smallInteger(),
            'title' => $this->string(),
            'description' => $this->string(),
            'keywords' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%articles}}');
    }
}
