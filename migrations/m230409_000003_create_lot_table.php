<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lot}}`.
 */
class m230409_000003_create_lot_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%lot}}', [
            'id' => $this->primaryKey()->unsigned(),
            'dt_add' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'user_id' => $this->integer()->notNull()->unsigned(),
            'category_id' => $this->integer()->notNull()->unsigned(),
            'name' => $this->string(128)->notNull()->unique(),
            'description' => $this->text()->null(),
            'image_path' => $this->string(128)->null()->unique(),
            'starting_price' => $this->integer()->notNull(),
            'deadline' => $this->date()->notNull(),
            'bet_step' => $this->integer()->notNull(),
            'closing_reason' => $this->string(256)->null(),
            'closing_reason_id' => $this->integer()->unsigned()->null(),
            'winner_bet_id' => $this->integer()->unsigned()->null()
        ]);

        // adding foreign key to table 'user'
        $this->addForeignKey(
            'fk-lot-user_id',
            'lot',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // adding foreign key to table 'category'
        $this->addForeignKey(
            'fk-lot-category_id',
            'lot',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );

        // adding foreign key to table 'closing_reason'
        $this->addForeignKey(
            'fk-lot-closing_reason_id',
            'lot',
            'closing_reason_id',
            'closing_reason',
            'id',
            'CASCADE'
        );

        $this->execute('ALTER TABLE lot ADD FULLTEXT INDEX idx_name (name)');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%lot}}');
    }
}
