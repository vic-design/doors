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
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%sliders}}', [
                'id' => $this->primaryKey(),
                'name' => $this->string()->unique(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%sliders}}');
    }
}
