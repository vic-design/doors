<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m171125_135755_create_users_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->unique(),
            'password' => $this->string(),
            'authKey' => $this->string(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%users}}');
    }
}
