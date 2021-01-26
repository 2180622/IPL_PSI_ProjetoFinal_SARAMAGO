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

        // Acesso geral dos leitores frontend
        $acessoFrontend = $auth->createPermission('acessoFrontend');
        $acessoFrontend->description = 'Aceder ao frontend';
        $auth->add($acessoFrontend);

        // Acesso geral dos operadores backend
        $acessoBackend = $auth->createPermission('acessoBackend');
        $acessoBackend->description = 'Aceder ao backend';
        $auth->add($acessoBackend);

        $acessoAdministracao = $auth->createPermission('acessoAdministracao');
        $acessoAdministracao->description = 'Aceder à página de administração';
        $auth->add($acessoAdministracao);

        $acessoCatalogo = $auth->createPermission('acessoCatalogo');
        $acessoCatalogo->description = 'Aceder à página Catálogo';
        $auth->add($acessoCatalogo);

        $acessoCirculacao = $auth->createPermission('acessoCirculacao');
        $acessoCirculacao->description = 'Aceder à página Circulação';
        $auth->add($acessoCirculacao);

        $acessoPostosDeTrabalho = $auth->createPermission('acessoPostosDeTrabalho');
        $acessoPostosDeTrabalho->description = 'Aceder á página Postos de Trabalho';
        $auth->add($acessoPostosDeTrabalho);

        $acessoServicosReprograficos = $auth->createPermission('acessoServicosReprograficos');
        $acessoServicosReprograficos->description = 'Aceder à pagina Serviços Reprográficos';
        $auth->add($acessoServicosReprograficos);

        $acessoLeitores = $auth->createPermission('acessoLeitores');
        $acessoLeitores->description = 'Aceder à página Leitores';
        $auth->add($acessoLeitores);

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

        $ativacaoCancelarReservaLivros = $auth->createPermission('ativacaoCancelarReservaLivros');
        $ativacaoCancelarReservaLivros->description = 'Ativacao do leitor poder cancelar a reserva de livros';
        $auth->add($ativacaoCancelarReservaLivros);

        $desativacaoCancelarReservaLivros = $auth->createPermission('desativacaoCancelarReservaLivros');
        $desativacaoCancelarReservaLivros->description = 'Ativacao do leitor poder cancelar a reserva de livros';
        $auth->add($desativacaoCancelarReservaLivros);

        $ativarObrasSlideShow = $auth->createPermission('ativarObrasSlideShow');
        $ativarObrasSlideShow->description = 'Ativar registo';
        $auth->add($ativarObrasSlideShow);

        $desativarObrasSlideShow = $auth->createPermission('desativarObrasSlideShow');
        $desativarObrasSlideShow->description = 'Desativar registo';
        $auth->add($desativarObrasSlideShow);

        #endregion

        #region Postos de Trabalho

        $verPostosTrabalho = $auth->createPermission('verPostosTrabalho');
        $verPostosTrabalho->description = 'Ver Postos de Trabalho';
        $auth->add($verPostosTrabalho);

        $inserirPostosTrabalho = $auth->createPermission('inserirPostosTrabalho');
        $inserirPostosTrabalho->description = 'Inserir Postos de Trabalho';
        $auth->add($inserirPostosTrabalho);

        $editarPostosTrabalho = $auth->createPermission('editarPostosTrabalho');
        $editarPostosTrabalho->description = 'Editar Postos de Trabalho';
        $auth->add($editarPostosTrabalho);

        $eliminarPostosTrabalho = $auth->createPermission('eliminarPostosTrabalho');
        $eliminarPostosTrabalho->description = 'Eliminar Postos de Trabalho';
        $auth->add($eliminarPostosTrabalho);

        // Tipo de postos de trabalho
        $verTipoPostosTrabalho = $auth->createPermission('verTipoPostosTrabalho');
        $verTipoPostosTrabalho->description = 'Ver o tipo de Postos de Trabalho';
        $auth->add($verTipoPostosTrabalho);

        $inserirTipoPostosTrabalho = $auth->createPermission('inserirTipoPostosTrabalho');
        $inserirTipoPostosTrabalho->description = 'Inserir o tipo de Postos de Trabalho';
        $auth->add($inserirTipoPostosTrabalho);

        $editarTipoPostosTrabalho = $auth->createPermission('editarTipoPostosTrabalho');
        $editarTipoPostosTrabalho->description = 'Editar o tipo de Postos de Trabalho';
        $auth->add($editarTipoPostosTrabalho);

        $eliminarTipoPostosTrabalho = $auth->createPermission('eliminarTipoPostosTrabalho');
        $eliminarTipoPostosTrabalho->description = 'Eliminar o tipo de Postos de Trabalho';
        $auth->add($eliminarTipoPostosTrabalho);

        #endregion

        #region Recibos

        // recibos de empréstimos
        $ativacaoRecibosEmprestimos = $auth->createPermission('ativacaoRecibosEmprestimos');
        $ativacaoRecibosEmprestimos->description = 'Ativacao de envio de recibos de Emprestimo';
        $auth->add($ativacaoRecibosEmprestimos);

        $desativacaoRecibosEmprestimos = $auth->createPermission('desativacaoRecibosEmprestimos');
        $desativacaoRecibosEmprestimos->description = 'Desativacao de envio de recibos de Emprestimo';
        $auth->add($desativacaoRecibosEmprestimos);

        // recibos de devoluções
        $ativacaoRecibosDevolucoes = $auth->createPermission('ativacaoRecibosDevolucoes');
        $ativacaoRecibosDevolucoes->description = 'Ativacao de envio de recibos de Devolucoes';
        $auth->add($ativacaoRecibosDevolucoes);

        $desativacaoRecibosDevolucoes = $auth->createPermission('desativacaoRecibosDevolucoes');
        $desativacaoRecibosDevolucoes->description = 'Desativacao de envio de recibos de Devolucoes';
        $auth->add($desativacaoRecibosDevolucoes);

        // recibos de renovações
        $ativacaoRecibosRenovacoes = $auth->createPermission('ativacaoRecibosRenovacoes');
        $ativacaoRecibosRenovacoes->description = 'Ativacao de envio de recibos de Renovacoes';
        $auth->add($ativacaoRecibosRenovacoes);

        $desativacaoRecibosRenovacoes = $auth->createPermission('desativacaoRecibosRenovacoes');
        $desativacaoRecibosRenovacoes->description = 'Desativacao de envio de recibos de Renovacoes';
        $auth->add($desativacaoRecibosRenovacoes);

        // recibos de reservas de exemplares
        $ativacaoRecibosReservasExemplares = $auth->createPermission('ativacaoRecibosReservasExemplares');
        $ativacaoRecibosReservasExemplares->description = 'Ativacao de envio de recibos de Reservas de Exemplares';
        $auth->add($ativacaoRecibosReservasExemplares);

        $desativacaoRecibosReservasExemplares = $auth->createPermission('desativacaoRecibosReservasExemplares');
        $desativacaoRecibosReservasExemplares->description = 'Desativacao de envio de recibos de Reservas de Exemplares';
        $auth->add($desativacaoRecibosReservasExemplares);

        //recibos de reservas de postos de trabalho
        $ativacaoRecibosReservaPostoTrabalho = $auth->createPermission('ativacaoRecibosReservaPostoTrabalho');
        $ativacaoRecibosReservaPostoTrabalho->description = 'Ativacao de envio de recibos de Reservas de Postos de Trabalho';
        $auth->add($ativacaoRecibosReservaPostoTrabalho);

        $desativacaoRecibosReservaPostoTrabalho = $auth->createPermission('desativacaoRecibosReservaPostoTrabalho');
        $desativacaoRecibosReservaPostoTrabalho->description = 'Desativacao de envio de recibos de Reservas de Postos de Trabalho';
        $auth->add($desativacaoRecibosReservaPostoTrabalho);

        #endregion

        #region Em Arrumação

        $ativacaoEmArrumacao = $auth->createPermission('ativacaoEmArrumacao');
        $ativacaoEmArrumacao->description = 'Ativação do módulo "Em arrumacao"';
        $auth->add($ativacaoEmArrumacao);

        $desativacaoEmArrumacao = $auth->createPermission('desativacaoEmArrumacao');
        $desativacaoEmArrumacao->description = 'Desativação do módulo "Em arrumacao"';
        $auth->add($desativacaoEmArrumacao);

        #endregion

        #region CDU

        $verCDU = $auth->createPermission('verCDU');
        $verCDU->description = 'Ver CDU';
        $auth->add($verCDU);

        $inserirCDU = $auth->createPermission('inserirCDU');
        $inserirCDU->description = 'Inserir CDU';
        $auth->add($inserirCDU);

        $eliminarCDU = $auth->createPermission('eliminarCDU');
        $eliminarCDU->description = 'Eliminar CDU';
        $auth->add($eliminarCDU);

        #endregion

        #region Irregularidades

        $verTiposIrregularidades = $auth->createPermission('verTiposIrregularidades');
        $verTiposIrregularidades->description = 'Ver Tipos de Irregularidades';
        $auth->add($verTiposIrregularidades);

        $inserirTiposIrregularidades = $auth->createPermission('inserirTiposIrregularidades');
        $inserirTiposIrregularidades->description = 'Inserir Tipos de Irregularidades';
        $auth->add($inserirTiposIrregularidades);

        $eliminarTiposIrregularidades = $auth->createPermission('eliminarTiposIrregularidades');
        $eliminarTiposIrregularidades->description = 'Eliminar Tipos de Irregularidades';
        $auth->add($eliminarTiposIrregularidades);

        #endregion

        #region Estatutos do Leitor

        $verTiposLeitor = $auth->createPermission('verTiposLeitor');
        $verTiposLeitor->description = 'Ver Tipos de Leitor';
        $auth->add($verTiposLeitor);

        $inserirTiposLeitor = $auth->createPermission('inserirTiposLeitor');
        $inserirTiposLeitor->description = 'Inserir Tipos de Leitor';
        $auth->add($inserirTiposLeitor);

        $eliminarTiposLeitor = $auth->createPermission('eliminarTiposLeitor');
        $eliminarTiposLeitor->description = 'Eliminar Tipos de Leitor';
        $auth->add($eliminarTiposLeitor);

        #endregion

        #region Tipos de Exemplares

        $verTiposExemplares = $auth->createPermission('verTiposExemplares');
        $verTiposExemplares->description = 'Ver Tipos de Exemplares';
        $auth->add($verTiposExemplares);

        $inserirTiposExemplares = $auth->createPermission('inserirTiposExemplares');
        $inserirTiposExemplares->description = 'Inserir Tipos de Exemplares';
        $auth->add($inserirTiposExemplares);

        $eliminarTiposExemplares = $auth->createPermission('eliminarTiposExemplares');
        $eliminarTiposExemplares->description = 'Eliminar Tipos de Exemplares';
        $auth->add($eliminarTiposExemplares);

        #endregion

        #region Estatuto dos Exemplares

        $verEstatutosExemplares = $auth->createPermission('verEstatutosExemplares');
        $verEstatutosExemplares->description = 'Ver Tipos de Exemplares';
        $auth->add($verEstatutosExemplares);

        $inserirEstatutosExemplares = $auth->createPermission('inserirEstatutosExemplares');
        $inserirEstatutosExemplares->description = 'Inserir Tipos de Exemplares';
        $auth->add($inserirEstatutosExemplares);

        $eliminarTiposExemplares = $auth->createPermission('eliminarEstatutosExemplares');
        $eliminarTiposExemplares->description = 'Eliminar Tipos de Exemplares';
        $auth->add($eliminarTiposExemplares);

        #endregion

        #region Logotipos

        $verLogotipos = $auth->createPermission('verLogotipos');
        $verLogotipos->description = 'Ver Logotipos';
        $auth->add($verLogotipos);

        $inserirLogotipos = $auth->createPermission('inserirLogotipos');
        $inserirLogotipos->description = 'Inserir Logotipos';
        $auth->add($inserirLogotipos);

        $eliminarLogotipos = $auth->createPermission('eliminarLogotipos');
        $eliminarLogotipos->description = 'Eliminar Logotipos';
        $auth->add($eliminarLogotipos);

        #endregion

        #region Listagem de Leitores

        $verLeitores = $auth->createPermission('verLeitores');
        $verLeitores->description = 'Visualização filtrada de Leitores';
        $auth->add($verLeitores);

        $inserirLeitores = $auth->createPermission('inserirLeitores');
        $inserirLeitores->description = 'Inserir Leitores';
        $auth->add($inserirLeitores);

        $editarLeitores = $auth->createPermission('editarLeitores');
        $editarLeitores->description = 'Editar Leitores';
        $auth->add($editarLeitores);

        $eliminarLeitores = $auth->createPermission('eliminarLeitores');
        $eliminarLeitores->description = 'Eliminar Leitores';
        $auth->add($eliminarLeitores);

        #endregion

        #region Ficha do leitor

        $verReservasLeitor = $auth->createPermission('verReservasLeitor');
        $verReservasLeitor->description = 'Visualização de Reservas do Leitor';
        $auth->add($verReservasLeitor);

        $verPedidosReprograficosLeitor = $auth->createPermission('verPedidosReprograficosLeitor');
        $verPedidosReprograficosLeitor->description = 'Visualização de pedidos Reprograficos do Leitor';
        $auth->add($verPedidosReprograficosLeitor);

        $verHistoricoLeitor = $auth->createPermission('verHistoricoLeitor');
        $verHistoricoLeitor->description = 'Visualização filtrada do Historico do Leitor';
        $auth->add($verHistoricoLeitor);

        #endregion

        #region Catalogacao

        // OBRAS
        $verObras = $auth->createPermission('verObras');
        $verObras->description = 'Visualização de Obras';
        $auth->add($verObras);

        $inserirObras = $auth->createPermission('inserirObras');
        $inserirObras->description = 'Insercao de Obras';
        $auth->add($inserirObras);

        $editarObras = $auth->createPermission('editarObras');
        $editarObras->description = 'Edicao de Obras';
        $auth->add($editarObras);

        $eliminarObras = $auth->createPermission('eliminarObras');
        $eliminarObras->description = 'Eliminacao de Obras';
        $auth->add($eliminarObras);

        // EXEMPLARES
        $verExemplares = $auth->createPermission('verExemplares');
        $verExemplares->description = 'Visualizacao de Exemplares';
        $auth->add($verExemplares);

        $inserirExemplares = $auth->createPermission('inserirExemplares');
        $inserirExemplares->description = 'Insercao de Exemplares';
        $auth->add($inserirExemplares);

        $editarExemplares = $auth->createPermission('editarExemplares');
        $editarExemplares->description = 'Edicao de Exemplares';
        $auth->add($editarExemplares);

        $eliminarExemplares = $auth->createPermission('eliminarExemplares');
        $eliminarExemplares->description = 'Eliminacao de Exemplares';
        $auth->add($eliminarExemplares);

        // EXEMPLARES PERDIDOS
        $verExemplaresPerdidos = $auth->createPermission('verExemplaresPerdidos');
        $verExemplaresPerdidos->description = 'Visualizacao de Exemplares Perdidos';
        $auth->add($verExemplaresPerdidos);

        $inserirExemplaresPerdidos = $auth->createPermission('inserirExemplaresPerdidos');
        $inserirExemplaresPerdidos->description = 'Insercao de Exemplares Perdidos';
        $auth->add($inserirExemplaresPerdidos);

        #endregion

        #region Empréstimos

        $inserirMultiplosEmprestimos = $auth->createPermission('inserirMultiplosEmprestimos');
        $inserirMultiplosEmprestimos->description = 'Inserção de multiplos empréstimos';
        $auth->add($inserirMultiplosEmprestimos);

        $verEmprestimosDia = $auth->createPermission('verEmprestimosDia');
        $verEmprestimosDia->description = 'Visualização rápida dos empréstimos efetuados no dia';
        $auth->add($verEmprestimosDia);

        $verExemplaresAtrasados = $auth->createPermission('verExemplaresAtrasados');
        $verExemplaresAtrasados->description = 'Visualização de exemplares atrasados';
        $auth->add($verExemplaresAtrasados);

        #endregion

        #region Consulta de Obras em Tempo Real

        $verFundoEspeciaisTR = $auth->createPermission('verFundoEspeciaisTR');
        $verFundoEspeciaisTR->description = 'Visualizacao de Consultas em Tempo Real de Fundo Especiais';
        $auth->add($verFundoEspeciaisTR);

        $inserirFundoEspeciaisTR = $auth->createPermission('inserirFundoEspeciaisTR');
        $inserirFundoEspeciaisTR->description = 'Insercao de Consultas em Tempo Real de Fundo Especiais';
        $auth->add($inserirFundoEspeciaisTR);

        $eliminarFundoEspeciaisTR = $auth->createPermission('eliminarFundoEspeciaisTR');
        $eliminarFundoEspeciaisTR->description = 'Eliminacao de Consultas em Tempo Real de Fundo Especiais';
        $auth->add($eliminarFundoEspeciaisTR);

        $verHistoricoFundoEspeciais = $auth->createPermission('verHistoricoFundoEspeciais');
        $verHistoricoFundoEspeciais->description = 'Visualizacaoo do Histórico de Consultas do Fundo Especiais';
        $auth->add($verHistoricoFundoEspeciais);

        #endregion

        #region Renovações

        $inserirRenovarEmprestimos = $auth->createPermission('inserirRenovarEmprestimos');
        $inserirRenovarEmprestimos->description = 'Inserção Rápida de Empréstimos a Renovar';
        $auth->add($inserirRenovarEmprestimos);

        #endregion

        #region Devoluções

        $inserirRenovacao = $auth->createPermission('inserirDevolucao');
        $inserirRenovacao->description = 'Insercao de uma Devolucao';
        $auth->add($inserirRenovacao);

        $verDevolucoesDia = $auth->createPermission('verDevolucoesDia');
        $verDevolucoesDia->description = 'Visualização Rápida de Devolucoes Efetuadas no Dia';
        $auth->add($verDevolucoesDia);

        #endregion

        #region Fila de Espera

        $verReservaFilaEspera = $auth->createPermission('verReservaFilaEspera');
        $verReservaFilaEspera->description = 'Visualizacao de Reservas em Fila de Espera';
        $auth->add($verReservaFilaEspera);

        $cancelarReservaFilaEspera = $auth->createPermission('cancelarReservaFilaEspera');
        $cancelarReservaFilaEspera->description = 'Cancelamento de Reservas em Fila de Espera';
        $auth->add($cancelarReservaFilaEspera);

        #endregion

        #region Aguarda Recolha

        $verReservaAguardaRecolha = $auth->createPermission('verReservaAguardaRecolha');
        $verReservaAguardaRecolha->description = 'Visualizacao de Reservas que Aguardam Recolha';
        $auth->add($verReservaAguardaRecolha);

        $cancelarReservaAguardaRecolha = $auth->createPermission('cancelarReservaAguardaRecolha');
        $cancelarReservaAguardaRecolha->description = 'Cancelamento de Reservas que Aguardam Recolha';
        $auth->add($cancelarReservaAguardaRecolha);

        #endregion

        #region Exemplares não Levantados

        $verReservaNaoLevantada = $auth->createPermission('verReservaNaoLevantada');
        $verReservaNaoLevantada->description = 'Visualizacao de Reservas Nao Levantadas';
        $auth->add($verReservaNaoLevantada);

        $retornarReservaNaoLevantada = $auth->createPermission('retornarReservaNaoLevantada');
        $retornarReservaNaoLevantada->description = 'Retorno de Reservas Nao Levantadas';
        $auth->add($retornarReservaNaoLevantada);

        #endregion

        #region Transferências

        $verExemplaresAReceber = $auth->createPermission('verExemplaresAReceber');
        $verExemplaresAReceber->description = 'Visualizacao de Exemplares a Receber';
        $auth->add($verExemplaresAReceber);

        #endregion

        #region Serviços Reprográficos

        $verPedidosReprograficos = $auth->createPermission('verPedidosReprograficos');
        $verPedidosReprograficos->description = 'Visualizacao de Pedidos Reprograficos';
        $auth->add($verPedidosReprograficos);

        $inserirPedidosReprograficos = $auth->createPermission('inserirPedidosReprograficos');
        $inserirPedidosReprograficos->description = 'Insercao de Pedidos Reprograficos';
        $auth->add($inserirPedidosReprograficos);

        $aceitarPedidosReprograficos = $auth->createPermission('aceitarPedidosReprograficos');
        $aceitarPedidosReprograficos->description = 'Aceitacao de Pedidos Reprograficos';
        $auth->add($aceitarPedidosReprograficos);

        $verPedidosRepPorLevantar = $auth->createPermission('verPedidosRepPorLevantar');
        $verPedidosRepPorLevantar->description = 'Visualizacao de Pedidos Reprograficos por Levantar';
        $auth->add($verPedidosRepPorLevantar);

        $verPedidosRepEntregues = $auth->createPermission('verPedidosRepEntregues');
        $verPedidosRepEntregues->description = 'Visualizacao de Pedidos Reprograficos Entregues ';
        $auth->add($verPedidosRepEntregues);

        #endregion

        #region Postos de Trabalho

        $verPostosTrabalhoOcupadosTR = $auth->createPermission('verPostosTrabalhoOcupadosTR');
        $verPostosTrabalhoOcupadosTR->description = 'Visualizacao de Postos de Trabalho Ocupados em Tempo Real';
        $auth->add($verPostosTrabalhoOcupadosTR);

        $verPostosTrabalhoTR = $auth->createPermission('verReservasPostosTrabalho');
        $verPostosTrabalhoTR->description = 'Visualizacao de Reservas de Postos de Trabalho';
        $auth->add($verPostosTrabalhoTR);

        $inserirReservasPostosTrabalho = $auth->createPermission('inserirReservasPostosTrabalho');
        $inserirReservasPostosTrabalho->description = 'Insercao de Reservas de Postos de Trabalho';
        $auth->add($inserirReservasPostosTrabalho);

        $eliminarReservasPostosTrabalho = $auth->createPermission('eliminarReservasPostosTrabalho');
        $eliminarReservasPostosTrabalho->description = 'Aceitacao de Pedidos Reprograficos';
        $auth->add($eliminarReservasPostosTrabalho);

        #endregion

        #region Área Pessoal

        $verMorada = $auth->createPermission('verMorada');
        $verMorada->description = 'Visualização de endereco/morada';
        $auth->add($verMorada);

        #endregion

        #region Notícias

        $verNoticias = $auth->createPermission('verNoticias');
        $verNoticias->description = 'Visualização de noticias gerais que a entidade disponibiliza';
        $auth->add($verNoticias);

        #endregion

        #region Horário de atividade / Contactos

        $verHorario = $auth->createPermission('verHorario');
        $verHorario->description = 'Ver horario de atividade';
        $auth->add($verHorario);

        #endregion


        // add "leitorAluno" role and give this role permissions
        // as well as the permissions of the "author" role
        $leitorAluno = $auth->createRole('leitorAluno');
        $auth->add($leitorAluno);
        $auth->addChild($leitorAluno, $acessoFrontend);

        // add "leitorExterno" role and give this role permissions
        // as well as the permissions of the "author" role
        $leitorExterno = $auth->createRole('leitorExterno');
        $auth->add($leitorExterno);
        $auth->addChild($leitorExterno, $acessoFrontend);
        //$auth->addChild($leitorExterno, $createPost);

        // add "leitorFuncionario" role and give this role permissions
        // as well as the permissions of the "author" role
        $leitorFuncionario = $auth->createRole('leitorFuncionario');
        $auth->add($leitorFuncionario);
        $auth->addChild($leitorFuncionario, $acessoFrontend);
        //$auth->addChild($leitorFuncionario, $createPost);

        // add "leitorDocente" role and give this role permissions
        // as well as the permissions of the "author" role
        $leitorDocente = $auth->createRole('leitorDocente');
        $auth->add($leitorDocente);
        $auth->addChild($leitorDocente, $acessoFrontend);
        //$auth->addChild($leitorDocente, $createPost);

        // add "operadorCirculacao" role and give this role permissions
        // as well as the permissions of the "author" role
        $operadorCirculacao = $auth->createRole('operadorCirculacao');
        $auth->add($operadorCirculacao);
        $auth->addChild($operadorCirculacao, $acessoBackend);
        $auth->addChild($operadorCirculacao, $acessoPostosDeTrabalho);
        $auth->addChild($operadorCirculacao, $acessoServicosReprograficos);
        $auth->addChild($operadorCirculacao, $acessoCirculacao);
        $auth->addChild($operadorCirculacao, $acessoCatalogo);
        $auth->addChild($operadorCirculacao, $acessoAdministracao);
        $auth->addChild($operadorCirculacao, $acessoLeitores);
        $auth->addChild($operadorCirculacao, $verExemplaresPerdidos);
        $auth->addChild($operadorCirculacao, $inserirExemplaresPerdidos);
        $auth->addChild($operadorCirculacao, $inserirMultiplosEmprestimos);
        $auth->addChild($operadorCirculacao, $verEmprestimosDia);
        $auth->addChild($operadorCirculacao, $verExemplaresAtrasados);
        $auth->addChild($operadorCirculacao, $inserirRenovarEmprestimos);
        $auth->addChild($operadorCirculacao, $inserirRenovacao);
        $auth->addChild($operadorCirculacao, $verDevolucoesDia);
        $auth->addChild($operadorCirculacao, $verReservaFilaEspera);
        $auth->addChild($operadorCirculacao, $cancelarReservaFilaEspera);
        $auth->addChild($operadorCirculacao, $verReservaAguardaRecolha);
        $auth->addChild($operadorCirculacao, $cancelarReservaAguardaRecolha);
        $auth->addChild($operadorCirculacao, $verReservaNaoLevantada);
        $auth->addChild($operadorCirculacao, $retornarReservaNaoLevantada);
        $auth->addChild($operadorCirculacao, $verExemplaresAReceber);
        //$auth->addChild($operadorCirculacao, $createPost);

        // add "operadorCatalogacao" role and give this role permissions
        // as well as the permissions of the "author" role
        $operadorCatalogacao = $auth->createRole('operadorCatalogacao');
        $auth->add($operadorCatalogacao);
        $auth->addChild($operadorCatalogacao, $acessoBackend);
        $auth->addChild($operadorCatalogacao, $acessoPostosDeTrabalho);
        $auth->addChild($operadorCatalogacao, $acessoServicosReprograficos);
        $auth->addChild($operadorCatalogacao, $acessoCirculacao);
        $auth->addChild($operadorCatalogacao, $acessoCatalogo);
        $auth->addChild($operadorCatalogacao, $acessoAdministracao);
        $auth->addChild($operadorCatalogacao, $acessoLeitores);
        $auth->addChild($operadorCatalogacao, $verCDU);
        $auth->addChild($operadorCatalogacao, $inserirCDU);
        $auth->addChild($operadorCatalogacao, $eliminarCDU);
        $auth->addChild($operadorCatalogacao, $verTiposExemplares);
        $auth->addChild($operadorCatalogacao, $inserirTiposExemplares);
        $auth->addChild($operadorCatalogacao, $eliminarTiposExemplares);
        $auth->addChild($operadorCatalogacao, $verEstatutosExemplares);
        $auth->addChild($operadorCatalogacao, $inserirEstatutosExemplares);
        $auth->addChild($operadorCatalogacao, $verLeitores);
        $auth->addChild($operadorCatalogacao, $inserirLeitores);
        $auth->addChild($operadorCatalogacao, $editarLeitores);
        $auth->addChild($operadorCatalogacao, $eliminarLeitores);
        $auth->addChild($operadorCatalogacao, $verTiposLeitor);
        $auth->addChild($operadorCatalogacao, $inserirTiposLeitor);
        $auth->addChild($operadorCatalogacao, $eliminarTiposLeitor);
        $auth->addChild($operadorCatalogacao, $verTiposIrregularidades);
        $auth->addChild($operadorCatalogacao, $inserirTiposIrregularidades);
        $auth->addChild($operadorCatalogacao, $eliminarTiposIrregularidades);
        $auth->addChild($operadorCatalogacao, $verObras);
        $auth->addChild($operadorCatalogacao, $inserirObras);
        $auth->addChild($operadorCatalogacao, $editarObras);
        $auth->addChild($operadorCatalogacao, $eliminarObras);
        $auth->addChild($operadorCatalogacao, $verExemplares);
        $auth->addChild($operadorCatalogacao, $inserirExemplares);
        $auth->addChild($operadorCatalogacao, $editarExemplares);
        $auth->addChild($operadorCatalogacao, $eliminarExemplares);

        

        //$auth->addChild($operadorCatalogacao, $createPost);

        // add "operadorChefe" role and give this role permissions
        // as well as the permissions of the "author" role
        $operadorChefe = $auth->createRole('operadorChefe');
        $auth->add($operadorChefe);
        $auth->addChild($operadorChefe, $acessoBackend);
        $auth->addChild($operadorChefe, $acessoPostosDeTrabalho);
        $auth->addChild($operadorChefe, $acessoServicosReprograficos);
        $auth->addChild($operadorChefe, $acessoCirculacao);
        $auth->addChild($operadorChefe, $acessoCatalogo);
        $auth->addChild($operadorChefe, $acessoAdministracao);
        $auth->addChild($operadorChefe, $acessoLeitores);
        $auth->addChild($operadorChefe, $verHorario);
        $auth->addChild($operadorChefe, $verNoticias);
        $auth->addChild($operadorChefe, $verMorada);
        $auth->addChild($operadorChefe, $verDadosEntidade);
        $auth->addChild($operadorChefe, $inserirDadosEntidade);
        $auth->addChild($operadorChefe, $editarDadosEntidade);
        $auth->addChild($operadorChefe, $verBibliotecas);
        $auth->addChild($operadorChefe, $inserirBibliotecas);
        $auth->addChild($operadorChefe, $eliminarBibliotecas);
        $auth->addChild($operadorChefe, $verPostosTrabalho);
        $auth->addChild($operadorChefe, $inserirPostosTrabalho);
        $auth->addChild($operadorChefe, $editarPostosTrabalho);
        $auth->addChild($operadorChefe, $eliminarPostosTrabalho);
        $auth->addChild($operadorChefe, $ativacaoRecibosEmprestimos);
        $auth->addChild($operadorChefe, $desativacaoRecibosEmprestimos);
        $auth->addChild($operadorChefe, $ativacaoRecibosDevolucoes);
        $auth->addChild($operadorChefe, $desativacaoRecibosDevolucoes);
        $auth->addChild($operadorChefe, $ativacaoRecibosRenovacoes);
        $auth->addChild($operadorChefe, $desativacaoRecibosRenovacoes);
        $auth->addChild($operadorChefe, $ativacaoRecibosReservasExemplares);
        $auth->addChild($operadorChefe, $desativacaoRecibosReservasExemplares);
        $auth->addChild($operadorChefe, $ativacaoRecibosReservaPostoTrabalho);
        $auth->addChild($operadorChefe, $desativacaoRecibosReservaPostoTrabalho);
        $auth->addChild($operadorChefe, $ativacaoCancelarReservaLivros);
        $auth->addChild($operadorChefe, $desativacaoCancelarReservaLivros);
        $auth->addChild($operadorChefe, $ativarObrasSlideShow);
        $auth->addChild($operadorChefe, $desativarObrasSlideShow);
        $auth->addChild($operadorChefe, $ativacaoEmArrumacao);
        $auth->addChild($operadorChefe, $desativacaoEmArrumacao);
        
       
        //$auth->addChild($operadorChefe, $createPost);

        // add "admin" role and give this role permissions
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $verOperadores);
        $auth->addChild($admin, $inserirOperadores);
        $auth->addChild($admin, $editarOperadores);
        $auth->addChild($admin, $eliminarOperadores);
        $auth->addChild($admin, $operadorChefe);
        $auth->addChild($admin, $operadorCatalogacao);
        $auth->addChild($admin, $operadorCirculacao);
        $auth->addChild($admin, $leitorDocente);
        $auth->addChild($admin, $leitorFuncionario);
        $auth->addChild($admin, $leitorExterno);
        $auth->addChild($admin, $leitorAluno);
        $admin->description = "Administrador";
        //$auth->addChild($admin, $createPost);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.

        $auth->assign($admin, 1);
    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }
}
