<?php

use yii\db\Migration;

/**
 * Handles the creation of table `related_assignments`.
 */
class m180114_073613_create_related_assignments_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%product_related_assignments}}', [
            'product_id' => $this->integer()->notNull(),
            'related_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('{{%pk-product_related_assignments}}', '{{%product_related_assignments}}', ['product_id', 'related_id']);

        $this->createIndex('{{%idx-product_related_assignments-product-id}}', '{{%product_related_assignments}}', 'product_id');
        $this->createIndex('{{%idx-product_related_assignments-related-id}}', '{{%product_related_assignments}}', 'related_id');

        $this->addForeignKey('{{%fk-product_related_assignments-product-id-id}}', '{{%product_related_assignments}}', 'product_id', '{{%shop_products}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('{{%fk-product_related_assignments-related-id-id}}', '{{%product_related_assignments}}', 'related_id', '{{%shop_products}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('{{%fk-product_related_assignments-related-id-id}}', '{{%product_related_assignments}}');
        $this->dropForeignKey('{{%fk-product_related_assignments-product-id-id}}', '{{%product_related_assignments}}');
        $this->dropTable('{{%product_related_assignments}}');
    }
}
