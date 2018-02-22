<?php

use yii\db\Migration;

/**
 * Handles adding size to table `shop_order_items`.
 */
class m180221_193928_add_size_column_to_shop_order_items_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%shop_order_items}}', 'size', $this->string()->after('modification_code'));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%shop_order_items}}', 'size');
    }
}
