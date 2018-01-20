<?php

use yii\db\Migration;

/**
 * Handles adding describe to table `shop_products`.
 */
class m180115_131922_add_describe_column_to_shop_products_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%shop_products}}', 'describe', $this->text()->after('frame_steel_thickness'));
        $this->addColumn('{{%shop_products}}', 'reveal', $this->string()->after('features'));
        $this->addColumn('{{%shop_products}}', 'opening', $this->string()->after('reveal'));
        $this->addColumn('{{%shop_products}}', 'cam', $this->text()->after('opening'));
        $this->addColumn('{{%shop_products}}', 'packing', $this->string()->after('cam'));
        $this->addColumn('{{%shop_products}}', 'door_insulation', $this->text()->after('packing'));
        $this->addColumn('{{%shop_products}}', 'box_insulation', $this->text()->after('door_insulation'));
        $this->addColumn('{{%shop_products}}', 'intensive', $this->text()->after('box_insulation'));
        $this->addColumn('{{%shop_products}}', 'bracing', $this->string()->after('intensive'));
        $this->addColumn('{{%shop_products}}', 'weight', $this->float()->after('bracing'));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%shop_products}}', 'describe');
        $this->dropColumn('{{%shop_products}}', 'reveal');
        $this->dropColumn('{{%shop_products}}', 'opening');
        $this->dropColumn('{{%shop_products}}', 'cam');
        $this->dropColumn('{{%shop_products}}', 'packing');
        $this->dropColumn('{{%shop_products}}', 'door_insulation');
        $this->dropColumn('{{%shop_products}}', 'box_insulation');
        $this->dropColumn('{{%shop_products}}', 'intensive');
        $this->dropColumn('{{%shop_products}}', 'bracing');
        $this->dropColumn('{{%shop_products}}', 'weight');
    }
}
