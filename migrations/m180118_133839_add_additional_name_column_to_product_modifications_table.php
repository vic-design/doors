<?php

use yii\db\Migration;

/**
 * Handles adding additional_name to table `product_modifications`.
 */
class m180118_133839_add_additional_name_column_to_product_modifications_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%product_modifications}}', 'additional_name', $this->string()->after('name'));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%product_modifications}}', 'additional_name');
    }
}
