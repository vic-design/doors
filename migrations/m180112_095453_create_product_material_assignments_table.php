<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_material_assignments`.
 */
class m180112_095453_create_product_material_assignments_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%product_material_assignments}}', [
            'product_id' => $this->integer()->notNull(),
            'material_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('{{%pk-product_material_assignments}}', '{{%product_material_assignments}}', ['product_id', 'material_id']);

        $this->createIndex('{{%idx-product_material_assignments-product-id}}', '{{%product_material_assignments}}', 'product_id');
        $this->createIndex('{{%idx-product_material_assignments-material-id}}', '{{%product_material_assignments}}', 'material_id');

        $this->addForeignKey('{{%fk-product_material_assignments-product-id-id}}', '{{%product_material_assignments}}', 'product_id', '{{%shop_products}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('{{%fk-product_material_assignments-material-id-id}}', '{{%product_material_assignments}}', 'product_id', '{{%shop_products}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('{{%k-product_material_assignments-material-id-id}}', '{{%product_material_assignments}}');
        $this->dropForeignKey('{{%fk-product_material_assignments-product-id-id}}', '{{%product_material_assignments}}');
        $this->dropTable('{{%product_material_assignments}}');
    }
}
