<?php

use yii\db\Migration;

/**
 * Handles the creation of table `stocks`.
 */
class m171128_180321_create_stocks_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%stocks}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'start_day' => $this->string(),
            'summary' => $this->text(),
            'body' => $this->text(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'title' => $this->string(),
            'description' => $this->string(),
            'keywords' => $this->string(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%stocks}}');
    }
}
