<?php

use yii\db\Migration;

/**
 * Handles adding old_price to table `shop_products`.
 */
class m180113_133423_add_old_price_column_to_shop_products_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%shop_products}}', 'old_price', $this->integer()->after('box_price'));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%shop_products}}', 'old_price');
    }
}
