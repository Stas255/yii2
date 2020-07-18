<?php

use yii\db\Migration;

/**
 * Class m200718_154651_add_delete_to_comment
 */
class m200718_154651_add_delete_to_comment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('comment','delete',$this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('comment','delete');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200718_154651_add_delete_to_comment cannot be reverted.\n";

        return false;
    }
    */
}
