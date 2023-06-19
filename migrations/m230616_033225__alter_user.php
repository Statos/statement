<?php

use yii\db\Migration;

/**
 * Class m230616_033225_alter_user
 */
class m230616_033225__alter_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'fio', $this->string(1024)->notNull());
        $this->addColumn('user', 'class', $this->string(255)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'fio');
        $this->dropColumn('user', 'class');
    }

}
