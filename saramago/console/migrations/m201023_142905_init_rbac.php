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

        #region Dados da Entidade
        // add "verDadosEntidade" permission
        $verDadosEntidade = $auth->createPermission('verDadosEntidade');
        $verDadosEntidade->description = 'Ver dados da entidade';
        $auth->add($verDadosEntidade);

        // add "inserirDadosEntidade" permission
        $inserirDadosEntidade = $auth->createPermission('inserirDadosEntidade');
        $inserirDadosEntidade->description = 'Inserir dados da entidade';
        $auth->add($inserirDadosEntidade);

        // add "editarDadosEntidade" permission
        $editarDadosEntidade = $auth->createPermission('editarDadosEntidade');
        $editarDadosEntidade->description = 'Editar dados da entidade';
        $auth->add($editarDadosEntidade);
        #endregion

        #region Horário de atividade

        // add "updatePost" permission
        $verHorario = $auth->createPermission('verHorario');
        $verHorario->description = 'Ver horario de atividade';
        $auth->add($verHorario);

        // add "updatePost" permission
        $inserirHorario = $auth->createPermission('inserirHorario');
        $inserirHorario->description = 'Inserir horario de atividade';
        $auth->add($inserirHorario);

        // add "updatePost" permission
        $editarHorario = $auth->createPermission('editarHorario');
        $editarHorario->description = 'Editar horario de atividade';
        $auth->add($editarHorario);

        #endregion

        #region Gestão de equipa

        // add "verOperadores" permission
        $verOperadores = $auth->createPermission('verOperadores');
        $verOperadores->description = 'Ver operadores';
        $auth->add($verOperadores);

        // add "inserirOperadores" permission
        $inserirOperadores = $auth->createPermission('inserirOperadores');
        $inserirOperadores->description = 'Inserir operadores';
        $auth->add($inserirOperadores);

        // add "editarOperadores" permission
        $editarOperadores = $auth->createPermission('editarOperadores');
        $editarOperadores->description = 'Editar operadores';
        $auth->add($editarOperadores);

        // add "eliminarOperadores" permission
        $eliminarOperadores = $auth->createPermission('eliminarOperadores');
        $eliminarOperadores->description = 'Eliminar operadores';
        $auth->add($eliminarOperadores);

        #endregion

        #region Bibliotecas

        $verBibliotecas = $auth->createPermission('verBibliotecas');
        $verBibliotecas->description = 'Ver Bibliotecas';
        $auth->add($verBibliotecas);

        $inserirBibliotecas = $auth->createPermission('inserirBibliotecas');
        $inserirBibliotecas->description = 'Inserir bibliotecas';
        $auth->add($inserirBibliotecas);

        $eliminarBibliotecas = $auth->createPermission('eliminarBibliotecas');
        $eliminarBibliotecas->description = 'Eliminar bibliotecas';
        $auth->add($eliminarBibliotecas);

        #endregion

        #region OPAC

        $ativarRegisto = $auth->createPermission('ativarRegisto');
        $ativarRegisto->description = 'Ativar registo';
        $auth->add($ativarRegisto);

        $desativarRegisto = $auth->createPermission('desativarRegisto');
        $desativarRegisto->description = 'Desativar registo';
        $auth->add($desativarRegisto);

        $ativacaoCancelarReservaLivros = $auth->createPermission('ativacaoCancelarReservaLivros');
        $ativacaoCancelarReservaLivros->description = 'Ativacao do leitor poder cancelar a reserva de livros';
        $auth->add($ativacaoCancelarReservaLivros);

        $desativacaoCancelarReservaLivros = $auth->createPermission('desativacaoCancelarReservaLivros');
        $desativacaoCancelarReservaLivros->description = 'Ativacao do leitor poder cancelar a reserva de livros';
        $auth->add($desativacaoCancelarReservaLivros);

        #endregion

        #region

        $desativacaoCancelarReservaLivros = $auth->createPermission('desativacaoCancelarReservaLivros');
        $desativacaoCancelarReservaLivros->description = 'Ativacao do leitor poder cancelar a reserva de livros';
        $auth->add($desativacaoCancelarReservaLivros);

        #endregion

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
        $auth->assign($leitorAluno, 7);
        $auth->assign($leitorExterno, 6);
        $auth->assign($leitorFuncionario, 5);
        $auth->assign($operadorCirculacao, 4);
        $auth->assign($operadorCatalogacao, 3);
        $auth->assign($operadorChefe, 2);
        $auth->assign($admin, 1);
    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }
}
