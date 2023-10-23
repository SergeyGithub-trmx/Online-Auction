<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bet}}`.
 */
class m230409_000004_create_bet_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%bet}}', [
            'id' => $this->primaryKey()->unsigned(),
            'dt_add' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'user_id' => $this->integer()->notNull()->unsigned(),
            'lot_id' => $this->integer()->notNull()->unsigned(),
            'summary' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'fk-bet-user_id',
            'bet',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-bet-lot_id',
            'bet',
            'lot_id',
            'lot',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%bet}}');
    }
}
