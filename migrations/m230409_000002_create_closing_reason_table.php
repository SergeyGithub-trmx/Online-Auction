<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%closing_reason}}`.
 */
class m230409_000002_create_closing_reason_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%closing_reason}}', [
            'id' => $this->primaryKey()->unsigned(),
            'dt_add' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'reason' => $this->string(256)->notNull()->unique()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%closing_reason}}');
    }
}
