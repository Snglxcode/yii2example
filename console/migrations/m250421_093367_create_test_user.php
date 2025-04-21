<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%client_club}}`.
 */
class m250421_093367_create_test_user extends Migration
{
    /**
     * {@inheritdoc}
     */public function safeUp()
{
    $this->insert('user', [
        'username' => 'admin',
        'auth_key' => Yii::$app->security->generateRandomString(),
        'password_hash' => Yii::$app->security->generatePasswordHash('adminpasswd'),
        'email' => 'test@example.com',
        'status' => 10,
        'created_at' => time(),
        'updated_at' => time(),
    ]);
}

    public function safeDown()
    {
        $this->delete('user', ['username' => 'admin']);

    }
}
