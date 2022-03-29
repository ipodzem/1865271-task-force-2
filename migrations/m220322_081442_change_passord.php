<?php

use yii\db\Migration;

/**
 * Class m220322_081442_change_passord
 */
class m220322_081442_change_passord extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%users}}', 'password', 'varchar(255)');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220322_081442_change_passord cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220322_081442_change_passord cannot be reverted.\n";

        return false;
    }
    */
}
