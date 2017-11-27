<?php

use yii\db\Migration;

/**
 * Handles the creation of table `sliders`.
 */
class m171127_111417_create_sliders_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('sliders', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('sliders');
    }
}
