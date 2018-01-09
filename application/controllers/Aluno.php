<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Aluno extends CI_Controller {

    function __construct() {

        parent::__construct();

        session_start();

        if (!isset($_SESSION["user_data"])) {
            redirect(base_url("index.php/login/"));
        }

        if($_SESSION["perm_data"]->perm_aluno == 0){
            $_SESSION["msg_err"] = "Voce não pode acessar essa tela :/";
            redirect(base_url());
        }
        
        $this->load->Model("Model_aluno", "aluno");
    }

    public function index() {

        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "lista" => ($_SESSION["user_data"]->codCargo == COD_CARGO_PROFESSOR) 
                ? $this->aluno->getAlunosProfessor($_SESSION["user_data"]->codReferencia) 
                : $this->aluno->getListaAlunos()
        );
        
        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('alunos/listarAlunos', $parametros);
        $this->load->view('inc/footer');
    }
    
    public function novo() {

        $this->load->Model("Model_cursos", "cursos");

        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "lista" => $this->cursos->getListaCursos()
        );
        
        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('alunos/inserirAluno', $parametros);
        $this->load->view('inc/footer');
    }
    
    public function inserir() {

        $codMatricula = $this->aluno->getMatricula();

        $parametrosR = array(
            "nome" => trim(filter_input(INPUT_POST, "txtNome")),
            "email" => trim(filter_input(INPUT_POST, "txtEmail", FILTER_SANITIZE_EMAIL)),
            "nascimento" => trim(filter_input(INPUT_POST, "txtNascimento")),
            "cpf" => trim(filter_input(INPUT_POST, "txtcpf")),
            "rg" => trim(filter_input(INPUT_POST, "txtRg")),
            "telefone" => trim(filter_input(INPUT_POST, "txtTel")),
            "celular" => trim(filter_input(INPUT_POST, "txtCel")),
            "logradouro" => trim(filter_input(INPUT_POST, "txtLogradouro")),
            "complemento" => trim(filter_input(INPUT_POST, "txtComplemento")),
            "bairro" => trim(filter_input(INPUT_POST, "txtBairro")),
            "cidade" => trim(filter_input(INPUT_POST, "txtCidade")),
            "cep" => trim(filter_input(INPUT_POST, "txtCep")),
            "pai" => trim(filter_input(INPUT_POST, "txtPai")),
            "mae" => trim(filter_input(INPUT_POST, "txtMae")),
            "profissao" => trim(filter_input(INPUT_POST, "txtProfissao")),
            "telefoneServico" => trim(filter_input(INPUT_POST, "txtTelComercial"))
        );
        
        $parametrosR["nascimento"] = 
                substr($parametrosR["nascimento"], 6, 4) . "-" .
                substr($parametrosR["nascimento"], 3, 2) . "-" .
                substr($parametrosR["nascimento"], 0, 2);

        $codRepresentante = $this->aluno->CadastrarRepresentante($parametrosR);
        
        $parametrosA = array(
            "codAluno" => $codMatricula,
            "nome" => trim(filter_input(INPUT_POST, "txtNomeAluno")),
            "email" => trim(filter_input(INPUT_POST, "txtEmailAluno", FILTER_SANITIZE_EMAIL)),
            "nascimento" => trim(filter_input(INPUT_POST, "txtNascimentoAluno")),
            "cpf" => trim(filter_input(INPUT_POST, "txtcpfAluno")),
            "rg" => trim(filter_input(INPUT_POST, "txtRgAluno")),
            "telefone" => trim(filter_input(INPUT_POST, "txtTelAluno")),
            "celular" => trim(filter_input(INPUT_POST, "txtCelAluno")),
            "logradouro" => trim(filter_input(INPUT_POST, "txtLogradouroAluno")),
            "complemento" => trim(filter_input(INPUT_POST, "txtComplementoAluno")),
            "bairro" => trim(filter_input(INPUT_POST, "txtBairroAluno")),
            "cidade" => trim(filter_input(INPUT_POST, "txtCidadeAluno")),
            "cep" => trim(filter_input(INPUT_POST, "txtCepAluno")),
            "pai" => trim(filter_input(INPUT_POST, "txtPaiAluno")),
            "mae" => trim(filter_input(INPUT_POST, "txtMaeAluno")),
            "codResponsavel" => $codRepresentante,
            "codInstituicao" => $_SESSION["inst_data"]->codInstituicao
        );
        
        $parametrosA["nascimento"] = 
            substr($parametrosA["nascimento"], 6, 4) . "-" .
            substr($parametrosA["nascimento"], 3, 2) . "-" .
            substr($parametrosA["nascimento"], 0, 2);

        $this->aluno->Cadastrar($parametrosA);

        $parametrosContrato = array(
			"codContrato" => $codMatricula,
            "codAluno" => $codMatricula,
            "valor" => floatval(trim(filter_input(INPUT_POST, "txtvalorCompra"))),
            "codCurso" => intval(trim(filter_input(INPUT_POST, "txtcodCurso"))),
            "valorParcela" => floatval(trim(filter_input(INPUT_POST, "txtValorParcela"))),
            "numParcelas" => intval(trim(filter_input(INPUT_POST, "txtNumParcelas"))),
            "codResponsavel" => $codRepresentante,
            "codInstituicao" => $_SESSION["inst_data"]->codInstituicao,
            "status" => 1
        );
        
        $this->db->insert("contrato", $parametrosContrato);

        $codContrato = $codMatricula;
        
        $codTurma = intval(trim(filter_input(INPUT_POST, "txtcodTurma")));
        
        $parametrosTurmaAluno = array(
            "codAluno" => $codMatricula,
            "codTurma" => $codTurma,
            "status" => 1
        );
        
        $this->db->insert("aluno_turma", $parametrosTurmaAluno);
        
        $dataVencimento = intval(trim(filter_input(INPUT_POST, "txtVencParc")));
        $date = date("Y-m-$dataVencimento");
        
        $pagamentoMatricula = trim(filter_input(INPUT_POST, "dataPagtoMatricula"));
        
        if(!(empty($pagamentoMatricula))){
            
            $valorMatricula = doubleval(trim(filter_input(INPUT_POST, "txtValorMatriculaPago")));
            
            $boletoMatricula = array(
                "codContrato" => $codContrato,
                "descricao" => "Refere-se a matrícula do contrato $codContrato",
                "valor" => $valorMatricula,
                "status" => 0,
                "codInstituicao" => $_SESSION["inst_data"]->codInstituicao,
                "dataVencimento" => substr($pagamentoMatricula, 6, 4) . "-" . substr($pagamentoMatricula, 3, 2) . "-" . substr($pagamentoMatricula, 0, 2),
                "dataPagto" => NULL,
                "Observacao" => ""
            );
            
            $this->db->insert("pagamento", $boletoMatricula);
            
        }
        
        for($i = 1; $i <= $parametrosContrato["numParcelas"]; $i++){
            
            $parametrosBoleto = array(
                "codContrato" => $codContrato,
                "descricao" => "Parcela " . str_pad($i, 3, "0", STR_PAD_LEFT) . " de " . str_pad($parametrosContrato["numParcelas"], 3, "0", STR_PAD_LEFT),
                "valor" => $parametrosContrato["valorParcela"],
                "status" => 0,
                "codInstituicao" => $_SESSION["inst_data"]->codInstituicao,
                "dataVencimento" => date("Y-m-d H:i:s",strtotime(date("Y-m-d", strtotime($date)) . "+$i months")),
                "dataPagto" => NULL,
                "Observacao" => ""
            );
            
            $this->db->insert("pagamento", $parametrosBoleto);
            
        }
        
        $_SESSION["msg_ok"] = "Cadastro efetuado com sucesso";
        
        redirect(base_url("index.php/aluno/"));
    }

    public function inserirAlunoJaExistente(){
        $parametros = array(
            "nome" => trim(filter_input(INPUT_POST, "txtNome")),
            "telefone" => trim(filter_input(INPUT_POST, "txtTel")),
            "codResponsavel" => trim(filter_input(INPUT_POST, "txtMatricula"))
        );

        $codResponsavel = $this->aluno->CadastrarRepresentante($parametros);

        $parametros["codAluno"] = $codResponsavel;
        $codContrato = $codResponsavel;
        
        $this->aluno->Cadastrar($parametros);
        
        $parametrosContrato = array(
            "codContrato" => $codContrato,
            "codAluno" => $codContrato,
            "valor" => 0,
            "codCurso" => intval(trim(filter_input(INPUT_POST, "txtcodCurso"))),
            "valorParcela" => 0,
            "numParcelas" => 0,
            "codResponsavel" => $codResponsavel,
            "codInstituicao" => $_SESSION["inst_data"]->codInstituicao,
            "status" => 1
        );
        
        $this->db->insert("contrato", $parametrosContrato);
        
        $codTurma = intval(trim(filter_input(INPUT_POST, "txtcodTurma")));
        
        $parametrosTurmaAluno = array(
            "codAluno" => $codResponsavel,
            "codTurma" => $codTurma,
            "status" => 1
        );
        
        $this->db->insert("aluno_turma", $parametrosTurmaAluno);
        
        $_SESSION["msg_ok"] = "Cadastro efetuado com sucesso";
        
        redirect(base_url("index.php/aluno/"));
    }
    
    public function novoCadastro(){
        $this->load->Model("Model_cursos", "cursos");

        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "lista" => $this->cursos->getListaCursos()
        );
        
        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('alunos/inserirAlunoSimples', $parametros);
        $this->load->view('inc/footer');
    }
    
    public function perfilAluno($codAluno){
        
        $contrato = $this->db->get_where("contrato", array("codAluno" => $codAluno))->row(0);
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "dadosAluno" => $this->aluno->getDetalhesAluno($codAluno)->row(0),
            "dadosChamada" => $this->aluno->getFaltas($codAluno)->row(0),
            "dadosObs" => $this->db->get_where("observacao_aluno", array("codAluno" => $codAluno), 0, 1),
            "boletos" => $this->db->get_where("pagamento", array("codContrato" => $contrato->codContrato)),
            "resumoAcademico" => $this->aluno->getResumoAcademicoByCicloLetivo($codAluno),
            "dadosCurso" => $this->db->get_where("cursos_oferecidos", array("codCurso" => $contrato->codCurso))->row(0),
            "vidaAcademica" => $this->aluno->getResumoAcademicoDetalhado($codAluno),
            "graficoPresencaAluno" => $this->aluno->getPresencasPorCiclo($codAluno),
            "dadosContrato" => $contrato
        );
        
        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('alunos/perfilAluno', $parametros);
        $this->load->view('inc/footer');
        
    }
        
    public function cancelarContrato() {
        
        $codAluno = intval(trim(filter_input(INPUT_POST, "codigo")));
        
        $codContrato = $this->db->get_where("contrato", array("codAluno" => $codAluno))->row(0)->codContrato;
        
        $novoStatus = (intval($_SESSION["perm_data"]->perm_direcao) == 2) ? STATUS_ALUNO_CANCELADO : STATUS_ALUNO_CANCELAMENTO_PENDENTE;
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "codContrato" => $codContrato,
            "codUsuario" => $_SESSION["user_data"]->codUsuario,
            "observacao" => "",
            "status" => $novoStatus
        );
        
        $this->db->insert("cancelamento", $parametros);
        
        $this->db->where("codAluno", $codAluno)->update("aluno_turma", array("status" => $novoStatus));
        $this->db->where("codAluno", $codAluno)->update("aluno", array("status" => $novoStatus));
        $this->db->where("codContrato", $codContrato)->update("contrato", array("status" => $novoStatus));
        
        if($novoStatus == STATUS_ALUNO_CANCELADO){
            $this->db->where("status", 0)->where("codContrato", $codContrato)->update("pagamento", array("status" =>  $novoStatus));
        }
                
    }

    public function updateStatus() {

        $cod = intval(trim(filter_input(INPUT_POST, "cod")));
        $status = intval(trim(filter_input(INPUT_POST, "novoStatus")));

        $this->db->where("codCurso", $cod)->update("curso", array("status" => $status));
    }
    
    public function listarFaltosos(){
        $parametros = array(
            "lista" => $this->aluno->getListaAlunosParaLigar($_SESSION["inst_data"]->codInstituicao)
        );
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );

        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('alunos/listarAlunosFaltosos', $parametros);
        $this->load->view('inc/footer');
    }
    
    public function alterarStatus(){
        
        $codAluno = intval(trim(filter_input(INPUT_POST, "codAluno")));
        $novoStatus = intval(trim(filter_input(INPUT_POST, "novoStatus"))); 

        $codContrato = $this->db->get_where("contrato", array("codAluno" => $codAluno))->row(0)->codContrato;
        
        $this->db->where("codAluno", $codAluno)->update("aluno_turma", array("status" => ($novoStatus == 1) ? 1 : -1));
        $this->db->where("status", 0)->where("codContrato", $codContrato)->update("pagamento", array("status" => ($novoStatus == 1) ? 0 : -1));
        $this->db->where("codAluno", $codAluno)->update("aluno", array("status" => $novoStatus));
        $this->db->where("codContrato", $codContrato)->update("contrato", array("status" => $novoStatus));
    }
    
    public function aniversariantes() {

        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "lista" => $this->aluno->getListaAlunosAniversariantes()
        );

        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('alunos/aniversariantes', $parametros);
        $this->load->view('inc/footer');
    }
    
    public function historico($codAluno){
        
        $dados = $this->aluno->getAluno($codAluno)->row(0);
        $frequenciaAluno = $this->aluno->getFrequencia($codAluno);
        
        $allFrequencies = array();
        
        foreach($frequenciaAluno->result() as $item){
            if($item->status == STATUS_ALUNO_CANCELADO){
                $allFrequencies["Ausente"] = intval($item->qtd);
            }else{
                $allFrequencies["Presente"] = intval($item->qtd);
            }
        }
        
        if(!isset($allFrequencies["Ausente"])){
            $allFrequencies["Ausente"] = 0;
        }
        
        if(!isset($allFrequencies["Presente"])){
            $allFrequencies["Presente"] = 0;
        }
        
        $allFrequencies["totalAulas"] = $allFrequencies["Ausente"] + $allFrequencies["Presente"]; 
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "dadosAluno" => $dados,
            "dadosResponsavel" => $this->aluno->getResponsavel($dados->codResponsavel)->row(0),
            "dadosContrato" => $this->db->get_where("contrato", array("codAluno" => $codAluno))->row(0),
            "historico" => $this->aluno->getCertifados($codAluno),
            "frequencia" => $allFrequencies,
            "observacoes" => $this->db->get_where("observacao_aluno", array("codAluno" => $codAluno)),
            "gerarCertificadoCompleto" => $this->aluno->getCertificadoFinal($codAluno)
        );
        
        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('alunos/historico', $parametros);
        $this->load->view('inc/footer');
        
    }
    
    public function visualizarPendencias($codAluno){
        
        $this->load->Model("Model_pagamentos", "pagto");
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "lista" => $this->pagto->getListaPagamentosAluno($codAluno)
        );
        
        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('pagamento/listagem', $parametros);
        $this->load->view('inc/footer');
        
    }
    
    public function visualizarPresencas($codAluno){
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "lista" => $this->aluno->getFaltas($codAluno)
        );
        
        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('alunos/listagemFrequencia', $parametros);
        $this->load->view('inc/footer');
    }
    
    public function Certificado($codAluno, $codModulo){
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "dadosAluno" => $this->db->get_where("aluno", array("codAluno" => $codAluno))->row(),
            "dadosModulo" => $this->db->get_where("itens_contrataveis", array("codItem" => $codModulo))->row(),
            "todosOsCertificados" => $this->aluno->getCertifados($codAluno),
            "dadosPresencas" => $this->db->get_where("gerenciapresencas", array("codAluno" => $codAluno)),
            "codAluno" => $codAluno
        );
        
        $this->load->view('outros/certificado', $parametros);
        
    }
    
    public function CertificadoFinal($codAluno, $codCurso){
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "dadosAluno" => $this->db->get_where("aluno", array("codAluno" => $codAluno))->row(),
            "dadosCurso" => $this->db->get_where("cursos_oferecidos", array("codCurso" => $codCurso))->row(),
            "todosOsCertificados" => $this->aluno->getCertifados($codAluno),
            "dadosPresencas" => $this->db->get_where("gerenciapresencas", array("codAluno" => $codAluno)),
            "codAluno" => $codAluno
        );
        
        $this->load->view('outros/certificadoFinal', $parametros);
        
    }
    
    public function getDadosDiploma(){
        
        $codAluno = intval(trim(filter_input(INPUT_POST, "codAluno")));
        $codModulo = intval(trim(filter_input(INPUT_POST, "codModulo")));
        
        $ret = $this->aluno->getCertifadoDetalhado($codAluno, $codModulo);
        echo json_encode($ret->result_array());
    }

    public function observacao($codAluno) {

        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "lista" => $this->aluno->getObservacoes($codAluno),
            "codAluno" => $codAluno
        );

        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('alunos/observacoes', $parametros);
        $this->load->view('inc/footer');
    }
    
    public function liberarVaga(){
        
        $codAluno = intval(trim(filter_input(INPUT_POST, "codAluno")));
        
        $codTurma = $this->db->get_where("aluno_turma", array("codAluno" => $codAluno, "status>" => 0))->row(0)->codTurma;
        $this->db->where("codAluno", $codAluno)->update("aluno", array("status" => -1));
        $this->db->set("numVagas", "numVagas+1", FALSE)->where("codTurma", $codTurma)->update("turma");
        $this->db->set("status", STATUS_ALUNO_CANCELADO)->where("codAluno", $codAluno)->where("codTurma", $codTurma)->update("aluno_turma");
        
    }
    
    public function retornarVaga(){
        
        $codAluno = intval(trim(filter_input(INPUT_POST, "codAluno")));
        $codTurma = $this->db->get_where("aluno_turma", array("codAluno" => $codAluno))->row(0)->codTurma;
        
        $this->db->where("codAluno", $codAluno)->update("aluno", array("status" => STATUS_ALUNO_NORMAL));
        $this->db->set("numVagas", "numVagas-1", FALSE)->where("codTurma", $codTurma)->update("turma");
        $this->db->where("codAluno", $codAluno)->where("codTurma", $codTurma)->update("aluno_turma", array("status" => STATUS_ALUNO_NORMAL));
        
    }
    
    public function transferencia($codAluno){
        
        $this->load->Model("Model_turma", "turma");
        
        $dadosTurma = $this->aluno->getTurmaAluno($codAluno)->row(0);
        
        //var_dump($dadosTurma);
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "lista" => $this->turma->getSalasMesmoCurso($dadosTurma->codTurma, 1),
            "codAluno" => $codAluno
        );
        
        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('alunos/transferencia', $parametros);
        $this->load->view('inc/footer');

    }
    
    public function confirmarTransferencia($codAluno, $codTurma){
        
        $momento = date("Y-m-d H:i:s");
        
        $this->db//->where("codTurma", $codTurma)
                ->where("codAluno", $codAluno)
                ->update("aluno_turma", array("status" => STATUS_ALUNO_CANCELADO, "dataMatricula" => $momento));
        
        $this->db->insert("aluno_turma", array(
            "codTurma" => $codTurma, 
            "codAluno" => $codAluno,
            "dataMatricula" => $momento,
            "status" => STATUS_ALUNO_NORMAL
        ));
        
        redirect(base_url("index.php/aluno/"));
        
    }
}