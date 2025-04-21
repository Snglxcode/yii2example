<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%client_club}}`.
 */
class m250421_093245_create_client_club_table extends Migration
{
    /**
     * {@inheritdoc}
     */public function safeUp()
{
    $this->createTable('{{%client_club}}', [
        'client_id' => $this->integer()->notNull(),
        'club_id' => $this->integer()->notNull(),
        'PRIMARY KEY(client_id, club_id)',
    ]);

}

    public function safeDown()
    {
        $this->dropTable('{{%client_club}}');
    }
}
