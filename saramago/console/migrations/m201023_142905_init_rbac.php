<?php

use yii\db\Migration;

/**
 * Class m201023_142905_init_rbac
 */
class m201023_142905_init_rbac extends Migration
{

    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m201023_142905_init_rbac cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $auth = Yii::$app->authManager;

        // add "createPost" permission
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);

        // add "updatePost" permission
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);

        // add "leitorAluno" role and give this role permissions
        // as well as the permissions of the "author" role
        $leitorAluno = $auth->createRole('leitorAluno');
        $auth->add($leitorAluno);
        $auth->addChild($leitorAluno, $createPost);

        // add "leitorExterno" role and give this role permissions
        // as well as the permissions of the "author" role
        $leitorExterno = $auth->createRole('leitorExterno');
        $auth->add($leitorExterno);
        $auth->addChild($leitorExterno, $createPost);

        // add "leitorFuncionario" role and give this role permissions
        // as well as the permissions of the "author" role
        $leitorFuncionario = $auth->createRole('leitorFuncionario');
        $auth->add($leitorFuncionario);
        $auth->addChild($leitorFuncionario, $createPost);

        // add "operadorCirculacao" role and give this role permissions
        // as well as the permissions of the "author" role
        $operadorCirculacao = $auth->createRole('operadorCirculacao');
        $auth->add($operadorCirculacao);
        $auth->addChild($operadorCirculacao, $createPost);

        // add "operadorCatalogacao" role and give this role permissions
        // as well as the permissions of the "author" role
        $operadorCatalogacao = $auth->createRole('operadorCatalogacao');
        $auth->add($operadorCatalogacao);
        $auth->addChild($operadorCatalogacao, $createPost);

        // add "operadorChefe" role and give this role permissions
        // as well as the permissions of the "author" role
        $operadorChefe = $auth->createRole('operadorChefe');
        $auth->add($operadorChefe);
        $auth->addChild($operadorChefe, $createPost);

        // add "admin" role and give this role permissions
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $createPost);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($leitorAluno, 2);
        $auth->assign($admin, 1);
    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }
}
