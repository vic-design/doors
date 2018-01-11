<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_colors`.
 */
class m180111_174413_create_product_colors_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product_colors', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('product_colors');
    }
}
