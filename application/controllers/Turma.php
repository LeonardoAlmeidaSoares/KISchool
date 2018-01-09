<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Turma extends CI_Controller {

    function __construct() {

        parent::__construct();

        session_start();

        if (!isset($_SESSION["user_data"])) {
            redirect(base_url("index.php/login/"));
        }

        if ($_SESSION["perm_data"]->perm_turmas == 0) {
            $_SESSION["msg_err"] = "Voce não pode acessar essa tela :/";
            redirect(base_url());
        }

        $this->load->Model("Model_turma", "turma");
    }

    public function index() {
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "lista" => ($_SESSION["user_data"]->codCargo == COD_CARGO_PROFESSOR) 
                ? $this->turma->getListaTurmasProfessor($_SESSION["user_data"]->codReferencia) 
                : $this->turma->getLista()
        );

        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('turma/listagemTurma', $parametros);
        $this->load->view('inc/footer');
    }

    public function novo() {
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $this->load->Model("Model_professor", "prof");
        $this->load->Model("Model_cursos", "curso");
        $this->load->Model("Model_instituicao", "inst");

        $parametros = array(
            "professores" => $this->prof->getListaProfessoresAtivos(),
            "cursos" => $this->curso->getListaCursos(),
            "instituicoes" => $this->inst->getInstituicoes()
        );

        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('turma/inserirTurma', $parametros);
        $this->load->view('inc/footer');
    }

    public function inserir() {

        $parametros = array(
            "descricao" => trim(filter_input(INPUT_POST, "txtNome")),
            "codCurso" => trim(filter_input(INPUT_POST, "txtCurso")),
            "codProfessor" => intval(trim(filter_input(INPUT_POST, "txtProfessor"))),
            "status" => 1,
            "dataInicio" => trim(filter_input(INPUT_POST, "txtInicio")),
            "horario" => trim(filter_input(INPUT_POST, "txtHorario")),
            "diaLetivo" => trim(filter_input(INPUT_POST, "txtDiaLetivo")),
            "numVagas" => intval(trim(filter_input(INPUT_POST, "txtNumVagas"))),
            "codInstituicao" => intval(trim(filter_input(INPUT_POST, "txtEscola")))
        );

        $this->turma->inserirTurma($parametros);

        $codTurma = $this->db->insert_id();
        
        $_SESSION["msg_ok"] = "Turma cadastrada com sucesso";

        redirect(base_url("index.php/turma/alterarSala/$codTurma"));
    }

    public function delete() {

        $cod = intval(trim(filter_input(INPUT_POST, "cod")));

        $this->db->where("codCurso", $cod)->delete("curso");
    }

    public function updateStatus() {

        $cod = intval(trim(filter_input(INPUT_POST, "cod")));
        $status = intval(trim(filter_input(INPUT_POST, "novoStatus")));

        $this->db->where("codCurso", $cod)->update("curso", array("status" => $status));
    }

    public function getTurmasAtivas() {

        $codCurso = intval(trim(filter_input(INPUT_POST, "codCurso")));

        $retItens = $this->db->get_where("turma", array("codCurso" => $codCurso));
        $retorno = $retItens->result_array();

        echo json_encode($retorno);
    }

    public function getTurma() {

        $codTurma = intval(trim(filter_input(INPUT_POST, "codTurma")));

        $ret = $this->db->get_where("turma", array("codTurma" => $codTurma));

        echo json_encode($ret->result_array());
    }

    public function listaAlunos($codTurma) {
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "alunos" => $this->turma->listaAlunosAtivos($codTurma),
            "turma" => $this->turma->getTurma($codTurma)->row(0)
        );

        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('turma/listaAlunos', $parametros);
        $this->load->view('inc/footer');
    }

    public function removerAluno($codAluno, $codTurma) {

        $this->db->where("codAluno", $codAluno)->where("codTurma", $codTurma)->delete("aluno_turma");
        redirect(base_url("index.php/turma/listaAlunos/$codTurma"));
    }

    public function chamada($codTurma) {
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "alunos" => $this->turma->listaAlunosAtivos($codTurma),
            "codTurma" => $codTurma,
            "chamadasHoje" => $this->db->get_where("chamada", array("CURDATE() = DATE_FORMAT(data,'%Y-%m-%d')" => null, "codTurma" => $codTurma))->num_rows()
        );
        echo $this->db->last_query();
        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('turma/chamada', $parametros);
        $this->load->view('inc/footer');
    }

    public function salvarChamada() {

        $codTurma = intval(trim(filter_input(INPUT_POST, "txtcodTurma")));
        $listaAlunos = $this->turma->listaAlunosAtivos($codTurma);

        $this->load->Model("Model_aluno", "aluno");

        $data = date('Y-m-d H:i');

        $ciclo = $this->db->get_where("ciclo_letivo", array("codTurma" => $codTurma, "fim" => NULL))->row(0);

        $parametros = array(
            "codTurma" => $codTurma,
            "codProfessor" => intval($_SESSION["user_data"]->codReferencia),
            "data" => $data,
            "codCiclo" => $ciclo->codCicloLetivo
        );

        $this->db->insert("chamada", $parametros);
        $codChamada = $this->db->insert_id();

        foreach ($listaAlunos->result() as $item) {
            $parametrosChamada = array(
                "codAluno" => $item->codAluno,
                "codChamada" => $codChamada,
                "status" => (isset($_POST["presenca_$item->codAluno"])) ? 1 : 0
            );
            
            $this->db->insert("marcacao_chamada", $parametrosChamada);

            $this->aluno->checkAlunoFaltoso($item->codAluno, LIMITE_FALTA_ALUNOS_PARA_LIGACAO);
            $this->aluno->checkAlunoAbandono($item->codAluno, LIMITE_FALTA_ALUNOS_PARA_ABANDONO, $codTurma);
        }

        $_SESSION["msg_ok"] = "Voce completou a chamada dessa aula";

        redirect(base_url("index.php/turma"));
    }

    public function gerirCertificados($codTurma) {
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "alunos" => $this->turma->listaAlunosAtivos($codTurma),
            "codTurma" => $codTurma,
            "modulos" => $this->turma->getModulos($codTurma)
        );

        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('turma/liberarCertificados', $parametros);
        $this->load->view('inc/footer');
    }

    public function salvarCertificados() {

        $codTurma = intval(trim(filter_input(INPUT_POST, "txtcodTurma")));

        $parametros = array(
            "codModulo" => intval(trim(filter_input(INPUT_POST, "txtCodModulo"))),
            "dataEmissaoCertificado" => date("Y-m-d"),
            "status" => COD_STATUS_COMPROVANTE_CRIADO
        );

        foreach ($_POST as $key => $value) {
            if (substr($key, 0, 5) == "cert_") {
                $parametros["codAluno"] = intval(substr($key, 5));
                $this->turma->inserirCertificado($parametros);
            }
        }

        $_SESSION["msg_ok"] = "Os certificados para os alunos foram gerados";

        redirect(base_url("index.php/turma/imprimirCertificados/$codTurma/" . $parametros["codModulo"]));
    }

    public function AlterarModulo($codTurma) {
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $dadosTurma = $this->db->get_where("turma", array("codTurma" => $codTurma))->row(0);

        $parametros = array(
            "dadosTurma" => $dadosTurma,
            "lista" => $this->turma->getModulos($codTurma)
        );

        $parametros["moduloAtual"] = ($dadosTurma->modulo > 0) ? $this->db->get_where("itens_contrataveis", array("codItem" => $dadosTurma->modulo))->row() : NULL;

        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('turma/associarModulo', $parametros);
        $this->load->view('inc/footer');
    }

    public function alterarModuloTurma() {

        $codTurma = intval(trim(filter_input(INPUT_POST, "txtCodTurma")));
        $codModulo = intval(trim(filter_input(INPUT_POST, "sel_modulo")));

        $parametros = array(
            "modulo" => $codModulo
        );

        $this->db->where("codTurma", $codTurma)->update("turma", $parametros);

        $parametros2 = array(
            "codModulo" => $codModulo,
            "codTurma" => $codTurma,
            "inicio" => date("Y-m-d"),
            "codProfessor" => $this->db->get_where("turma", array("codTurma" => $codTurma))->row(0)->codProfessor
        );

        $this->db->insert("ciclo_letivo", $parametros2);
        
        $modulo = $this->db->get_where("itens_contrataveis", array("codItem" => $codModulo));
        $turma = $this->db->get_where("turma", array("codTurma" => $codTurma));
        
        $this->db->insert("notificacao", array(
            "status" => COD_NOTIFICACAO_ABERTA,
            "mensagem" => "O Módulo " . $modulo->row(0)->descricao . " foi finalizado em " . $turma->row(0)->descricao,
            "titulo" => "Módulo Finalizado",
            "codUsuario" => 0
        ));
        
        $this->turma->gerarMedia($codTurma);

        $_SESSION["msg_ok"] = "A atualização foi feita";
        redirect(base_url("index.php/turma"));
    }

    public function imprimirCertificados($codTurma, $codModulo) {

        $this->load->Model("Model_aluno", "aluno");

        $listaAlunos = $this->turma->getCertificadosAImprimir($codTurma, $codModulo);
        
        $parametros = array(
            "listaAlunos" => $listaAlunos
        );

        $this->load->view('outros/multiplos_certificados', $parametros);
        
    }
    
    public function alterarSala($codTurma){
                
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $this->load->Model("Model_salas", "salas");
        
        $parametros = array(
            "lista" => $this->salas->getListadeSalas($_SESSION["inst_data"]->codInstituicao),
            "minhaSala" => $this->salas->getSalaByTurma($codTurma)->row(0),
            "codTurma" => $codTurma
        );

        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('sala/alterarSala', $parametros);
        $this->load->view('inc/footer');
        
    }
    
    public function novaSala(){
        
        $this->load->Model("Model_salas", "salas");
        
        $codTurma = intval(trim(filter_input(INPUT_POST, "codTurma")));
        $codSala = intval(trim(filter_input(INPUT_POST, "codSala")));
        
        $parametros = array(
            "codSala" => $codSala,
            "codTurma" => $codTurma
        );
        
        $this->salas->setarSala($parametros);
        echo $this->db->last_query();
        
    }
    
}