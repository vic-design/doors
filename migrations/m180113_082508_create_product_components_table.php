<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_components`.
 */
class m180113_082508_create_product_components_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product_components', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('product_components');
    }
}
