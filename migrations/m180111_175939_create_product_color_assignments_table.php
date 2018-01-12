<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_color_assignments`.
 */
class m180111_175939_create_product_color_assignments_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%product_color_assignments}}', [
            'product_id' => $this->integer()->notNull(),
            'color_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('{{%pk-product_color_assignments}}', '{{%product_color_assignments}}', ['product_id', 'color_id']);

        $this->createIndex('{{%idx-product_color_assignments-product-id}}', '{{%product_color_assignments}}', 'product_id');
        $this->createIndex('{{%idx-product_color_assignments-color-id}}', '{{%product_color_assignments}}', 'color_id');

        $this->addForeignKey('{{%fk-product_color_assignments-product-id-id}}', '{{%product_color_assignments}}', 'product_id', '{{%shop_products}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('{{%fk-product_color_assignments-color-id-id}}', '{{%product_color_assignments}}', 'color_id', '{{%product_colors}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('{{%fk-product_color_assignments-product-id-id}}', '{{%product_color_assignments}}');
        $this->dropForeignKey('{{%fk-product_color_assignments-color-id-id}}', '{{%product_color_assignments}}');
        $this->dropTable('{{product_color_assignments}}');
    }
}
