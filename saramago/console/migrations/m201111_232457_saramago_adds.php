<?php

use yii\db\Migration;

/**
 * Class m201111_232457_saramago_adds
 */
class m201111_232457_saramago_adds extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201111_232457_saramago_adds cannot be reverted.\n";

        return false;
    }

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        // TODO: Listar no relatório
        $this->addColumn('{{%Leitor}}', 'user_id', $this->integer()->notNull());

        $this->addForeignKey('FK_user_id', '{{%Leitor}}', 'user_id', '{{%user}}', 'id', $delete = null, $update = null);

        $this->insert('user', [
            'id' => '1',
            'username' => 'admin',
            'auth_key' => '8zBomsps5mCNjOxI6d64LfgHs1bR70wW',
            'password_hash' => '$2y$13$6Oajs8EG04CCH84AoiguE.axGBGkmd9KMOkDx5T4/Y2GIoN9kAwsi',
            'password_reset_token' => null,
            'email' => 'admin@saramago.pt',
            'status' => '10',
            'created_at' => '1578482095',
            'updated_at' => '1578482095',
            'verification_token' => null,
        ]);


        //
    }

    public function down()
    {

        $this->delete('{{%user}}', ['id' => 1]);

        $this->dropForeignKey('FK_user_id', '{{%Leitor}}');

        $this->dropColumn('{{%Leitor}}', 'user_id');

    }
    
}
