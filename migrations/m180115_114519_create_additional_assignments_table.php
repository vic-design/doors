<?php

use yii\db\Migration;

/**
 * Handles the creation of table `additional_assignments`.
 */
class m180115_114519_create_additional_assignments_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%additional_assignments}}', [
            'product_id' => $this->integer()->notNull(),
            'additional_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('{{%pk-additional_assignments}}', '{{%additional_assignments}}', ['product_id', 'additional_id']);

        $this->createIndex('{{%idx-additional_assignments-product-id}}', '{{%additional_assignments}}', 'product_id');
        $this->createIndex('{{%idx-additional_assignments-additional-id}}', '{{%additional_assignments}}', 'additional_id');

        $this->addForeignKey('{{%fk-additional_assignments-product-id-id}}', '{{%additional_assignments}}', 'product_id', '{{%shop_products}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('{{%fk-additional_assignments-additional-id-id}}', '{{%additional_assignments}}', 'additional_id', '{{%shop_products}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('{{%fk-additional_assignments-additional-id-id}}', '{{%additional_assignments}}');
        $this->dropForeignKey('{{%fk-additional_assignments-product-id-id}}', '{{%additional_assignments}}');
        $this->dropTable('{{%additional_assignments}}');
    }
}
