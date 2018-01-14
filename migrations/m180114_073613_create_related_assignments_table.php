<?php

use yii\db\Migration;

/**
 * Handles the creation of table `related_assignments`.
 */
class m180114_073613_create_related_assignments_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('related_assignments', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('related_assignments');
    }
}
