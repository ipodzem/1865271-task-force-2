<?php

use yii\db\Migration;

/**
 * Class m220312_121827_add_user_score
 */
class m220312_121827_add_user_score extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("users", "score", "float");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn("users", "score");

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220312_121827_add_user_score cannot be reverted.\n";

        return false;
    }
    */
}
