<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%session}}`.
 */
class m220607_035607_create_session_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%session}}', [
            'id' => $this->primaryKey(),
            'expire' => $this->integer(),
            'data' => $this->binary(429496729),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%session}}');
    }
}
