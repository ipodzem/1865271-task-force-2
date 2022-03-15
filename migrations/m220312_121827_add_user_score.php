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
    }

}
