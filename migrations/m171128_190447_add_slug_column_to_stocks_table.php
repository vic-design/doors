<?php

use yii\db\Migration;

/**
 * Handles adding slug to table `stocks`.
 */
class m171128_190447_add_slug_column_to_stocks_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%stocks}}', 'slug', $this->string()->after('body'));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%stocks}}', 'slug');
    }
}
