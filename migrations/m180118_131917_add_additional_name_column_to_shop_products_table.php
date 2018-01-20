<?php

use yii\db\Migration;

/**
 * Handles adding additional_name to table `shop_products`.
 */
class m180118_131917_add_additional_name_column_to_shop_products_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%shop_products}}', 'additional_name', $this->string()->after('name'));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%shop_products}}', 'additional_name');
    }
}
