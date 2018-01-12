<?php

use yii\db\Migration;

/**
 * Handles the creation of table `shop_product_photos`.
 */
class m180107_093912_create_shop_product_photos_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%shop_product_photos}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'file' => $this->string()->notNull(),
            'sort' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('{{%idx-shop_product_photos-product-id}}', '{{%shop_product_photos}}', 'product_id');

        $this->addForeignKey('{{%fk-shop_product_photos-product-id-id}}', '{{%shop_product_photos}}', 'product_id', '{{%shop_products}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%shop_product_photos}}');
    }
}
