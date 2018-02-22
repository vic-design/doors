<?php

use yii\db\Migration;

/**
 * Handles adding customer_email to table `shop_orders`.
 */
class m180219_091225_add_customer_email_column_to_shop_orders_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%shop_orders}}', 'customer_email', $this->string()->after('customer_phone'));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%shop_orders}}', 'customer_email');
    }
}
