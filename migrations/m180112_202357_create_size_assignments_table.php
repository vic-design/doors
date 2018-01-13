<?php

use yii\db\Migration;

/**
 * Handles the creation of table `size_assignments`.
 */
class m180112_202357_create_size_assignments_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%size_assignments}}', [
            'product_id' => $this->integer()->notNull(),
            'size_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('{{%pk-size_assignments}}', '{{%size_assignments}}', ['product_id', 'size_id']);

        $this->createIndex('{{%idx-size_assignments-product-id}}', '{{%size_assignments}}', 'product_id');
        $this->createIndex('{{%idx-size_assignments-size-id}}', '{{%size_assignments}}', 'size_id');

        $this->addForeignKey('{{%fk-size_assignments-product-id-id}}', '{{%size_assignments}}', 'product_id', '{{%shop_products}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('{{%fk-size_assignments-size-id-id}}', '{{%size_assignments}}', 'size_id', '{{%product_size}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('{{%fk-size_assignments-size-id-id}}', '{{%size_assignments}}');
        $this->dropForeignKey('{{%fk-size_assignments-product-id-id}}', '{{%size_assignments}}');
        $this->dropTable('{{%size_assignments}}');
    }
}
