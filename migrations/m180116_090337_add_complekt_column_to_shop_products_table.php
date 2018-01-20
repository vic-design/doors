<?php

use yii\db\Migration;

/**
 * Handles adding complekt to table `shop_products`.
 */
class m180116_090337_add_complekt_column_to_shop_products_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%shop_products}}', 'complect', $this->text()->after('opening'));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('shop_products', '{{%complect}}');
    }
}
