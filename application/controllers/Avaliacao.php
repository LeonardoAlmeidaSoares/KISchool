<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Avaliacao extends CI_Controller {

    function __construct() {

        parent::__construct();

        session_start();

        if(!isset($_SESSION["user_data"])){
            redirect(base_url("index.php/login/"));
        }
        
        if($_SESSION["perm_data"]->perm_turmas == 0){
            $_SESSION["msg_err"] = "Voce não pode acessar essa tela :/";
            redirect(base_url());
        }
        
        $this->load->Model("Model_avaliacao", "prova");
    }

    public function listagem($codTurma) {

        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "lista" => $this->prova->getListagem($codTurma),
            "codTurma" => $codTurma
        );
        
        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('avaliacao/listarAvaliacoes', $parametros);
        $this->load->view('inc/footer');
    }

    public function novo($codTurma){
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "turma" => $this->db->get_where("turma", array('codTurma'=>$codTurma))
        );
        
        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('avaliacao/inserir', $parametros);
        $this->load->view('inc/footer');
        
    }
    
    public function inserir() {
        
        $parametros = array(
            "nome" => trim(filter_input(INPUT_POST, "txtNome")),
            "observacao" => trim(filter_input(INPUT_POST, "txtDescricao")),
            "codTurma" => intval(trim(filter_input(INPUT_POST, "txtCodTurma"))),
            "codProfessor" => intval(trim($_SESSION["user_data"]->codReferencia)),
            "dataAplicacao" => filter_input(INPUT_POST, "txtData"),
            "valorTotal" => intval(trim(filter_input(INPUT_POST, "txtValor"))),
            "status" => COD_AVALIACAO_MARCADA,
            "modulo" => intval(trim($this->turma->getModuloAtual(filter_input(INPUT_POST, "txtCodTurma"))->row(0)->modulo))
        );
        
    	$date = explode(" ", $parametros["dataAplicacao"]);
    	$arrDia = explode("/", $date[0]);

    	$parametros["dataAplicacao"] = $arrDia[2] . "-" . $arrDia[1] . "-" . $arrDia[0] . " " . $date[1];
            
        $cod = intval(trim(filter_input(INPUT_POST, "txtCodTurma")));
        
        $this->db->insert("avaliacao", $parametros);
        redirect(base_url("index.php/avaliacao/listagem/$cod"));
    }
    
    public function listarNotas($codAvaliacao){
        
        $this->load->Model("Model_turma", "turma");
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $aval = $this->prova->get($codAvaliacao)->row(0);
        $turma = $this->turma->getTurma($aval->codTurma)->row(0);
        $listaAlunos = $this->turma->listaAlunosAtivos($turma->codTurma);
        
        $parametros = array(
            "listaAlunos" => $listaAlunos,
            "avaliacao" => $aval
        );
        
        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('avaliacao/setarNotas', $parametros);
        $this->load->view('inc/footer');
        
    }
    
    public function salvarNotas(){
        
        $codAvaliacao = intval(trim(filter_input(INPUT_POST, "txtCodAvaliacao")));
        $codTurma = intval(trim(filter_input(INPUT_POST, "txtCodTurma")));
        
        //var_dump($_POST);
        $listaAlunos = array();
        
        $parametros["codAvaliacao"] = $codAvaliacao;
        
        foreach($_POST as $key=>$value){
            if(substr($key, 0, 5) == "nota_"){
                //$listaAlunos[intval(trim(substr($key, 5)))] = $value;
                $parametros["codAluno"] = intval(trim(substr($key, 5)));
                $parametros["nota"] = $value;
                $this->db->insert("nota_avaliacao", $parametros);
            }
        }
        
        $this->db->where("codAvaliacao", $codAvaliacao)->update("avaliacao", array(
            "status" => COD_AVALIACAO_EFETUADA
        ));
        
        $_SESSION["msg_ok"] = "Notas Adicionadas com sucesso";
        redirect(base_url("index.php/avaliacao/listagem/$codTurma"));
    }
    
    /*
    public function delete(){
        
        $cod = intval(trim(filter_input(INPUT_POST, "cod")));
        
        $this->db->where("codCurso", $cod)->delete("curso");
        
    }
    
    public function updateStatus(){
        
        $cod = intval(trim(filter_input(INPUT_POST, "cod")));
        $status = intval(trim(filter_input(INPUT_POST, "novoStatus")));
        
        $this->db->where("codCurso", $cod)->update("curso", array("status" => $status));
    }
    
    public function getModulos(){
        
        $codCurso = intval(trim(filter_input(INPUT_POST, "codCurso")));
        
        $retItens = $this->db->get_where("itens_contrataveis", array("codCurso" => $codCurso));
        $retorno = $retItens->result_array();
        
        $valorCurso = $this->db->get_where("cursos_oferecidos", array("codCurso" => $codCurso))->row(0)->valor;
        
        for($i=0; $i<count($retorno); $i++){
            $retorno[$i]["valor"] = $valorCurso / count($retorno);
        }
        
        echo json_encode($retorno);
    }
    */
}
