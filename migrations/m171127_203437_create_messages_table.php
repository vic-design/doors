<?php

use yii\db\Migration;

/**
 * Handles the creation of table `messages`.
 */
class m171127_203437_create_messages_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('messages', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('messages');
    }
}
