<?php

use yii\db\Migration;

/**
 * Handles adding cancelled_reason to table `shop_orders`.
 */
class m180219_083726_add_cancelled_reason_column_to_shop_orders_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%shop_orders}}', 'cancelled_reason', $this->text()->after('note'));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%shop_orders}}', 'cancelled_reason');
    }
}
