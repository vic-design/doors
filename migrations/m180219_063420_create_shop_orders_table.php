<?php

use yii\db\Migration;

/**
 * Handles the creation of table `shop_orders`.
 */
class m180219_063420_create_shop_orders_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%shop_orders}}', [
            'id' => $this->primaryKey(),
            'customer_name' => $this->string(),
            'customer_phone' => $this->string(),
            'cost' => $this->integer()->notNull(),
            'note' => $this->text(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%shop_orders}}');
    }
}
