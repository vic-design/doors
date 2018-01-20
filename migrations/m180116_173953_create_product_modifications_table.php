<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_modifications`.
 */
class m180116_173953_create_product_modifications_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%product_modifications}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'code' => $this->string()->notNull(),
            'price' => $this->integer()->notNull(),
            'image' => $this->string(),
        ], $tableOptions);

        $this->createIndex('{{%idx-product_modifications-code}}', '{{%product_modifications}}', 'code');
        $this->createIndex('{{%idx-product_modifications-product-id-code}}', '{{%product_modifications}}', ['product_id', 'code'], true);
        $this->createIndex('{{%idx-product_modifications-product-id}}', '{{%product_modifications}}', 'product_id');

        $this->addForeignKey('{{%fk-product_modifications-product-id-id}}', '{{%product_modifications}}', 'product_id', '{{%shop_products}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%product_modifications}}');
    }
}
