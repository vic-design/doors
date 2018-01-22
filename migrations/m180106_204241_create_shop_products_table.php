<?php

use yii\db\Migration;

/**
 * Handles the creation of table `shop_products`.
 */
class m180106_204241_create_shop_products_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci';

        $this->createTable('{{%shop_products}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'main_photo_id' => $this->integer(),
            'code' => $this->string()->notNull(),
            'body' => $this->text(),
            'door_old_price' => $this->integer(),
            'box_old_price' => $this->integer(),
            'box_price' => $this->integer(),
            'price' => $this->integer()->notNull(),
            'slug' => $this->string(),
            'status' => $this->smallInteger(),
            'door_thickness' => $this->float(),
            'door_frame_thickness' => $this->float(),
            'door_steel_thickness' => $this->float(),
            'frame_steel_thickness' => $this->float(),
            'features' => $this->text(),
            'inner_facing' => $this->string(),
            'out_facing' => $this->string(),
            'glass' => $this->string(),
            'title' => $this->string(),
            'description' => $this->string(),
            'keywords' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('{{%idx-shop_products-code}}', '{{%shop_products}}', 'code', true);
        $this->createIndex('{{%idx-shop_products-slug}}', '{{%shop_products}}', 'slug', true);
        $this->createIndex('{{%idx-shop_products-main-photo}}', '{{%shop_products}}', 'main_photo_id');

        $this->addForeignKey('{{%fk-shop_products-catalog-id-id}}', '{{%shop_products}}', 'category_id', '{{%shop_categories}}', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%shop_products}}');
    }
}
