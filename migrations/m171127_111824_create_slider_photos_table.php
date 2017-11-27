<?php

use yii\db\Migration;

/**
 * Handles the creation of table `slider_photos`.
 */
class m171127_111824_create_slider_photos_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%slider_photos}}', [
                'id' => $this->primaryKey(),
                'slider_id' => $this->integer()->notNull(),
                'file' => $this->string(),
                'sort' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('{{%idx-slider_photos-product-id}}', '{{%slider_photos}}', 'slider_id');

        $this->addForeignKey('{{%fk-slider_photos-slider-id-id}}', '{{%slider_photos}}', 'slider_id', '{{%sliders}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%slider_photos}}');
    }
}
