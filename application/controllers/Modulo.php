<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Modulo extends CI_Controller {

    function __construct() {

        parent::__construct();

        session_start();

        if (!isset($_SESSION["user_data"])) {
            redirect(base_url("index.php/login/"));
        }

        if ($_SESSION["perm_data"]->perm_cursos == 0) {
            $_SESSION["msg_err"] = "Voce não pode acessar essa tela :/";
            redirect(base_url());
        }

        $this->load->Model("Model_cursos_oferecidos", "cursos");
    }

    public function getModulos($codCurso = 0) {
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array();
        
        if ($codCurso > 0) {
            $parametros["itens"] = $this->db->get_where("itens_contrataveis", array("codCurso" => $codCurso));
            $parametros["curso"] = $this->db->get_where("cursos_oferecidos", array("codCurso" => $codCurso))->row(0);
        }else{
            $parametros["itens"] = $this->db->get_where("itens_contrataveis", array("status>=" => 0));
            $parametros["curso"] = $this->db->get_where("cursos_oferecidos", array("status>=" => 0))->row(0);
        }

        
        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('cursos_oferecidos/listarModulos', $parametros);
        $this->load->view('inc/footer');
        
    }

    public function novo() {
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "lista" => $this->cursos->getListaCursos()
        );

        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('cursos_oferecidos/inserirModulo', $parametros);
        $this->load->view('inc/footer');
    }

    public function inserir() {

        $parametros = array(
            "descricao" => trim(filter_input(INPUT_POST, "txtNome")),
            "codCurso" => intval(trim(filter_input(INPUT_POST, "txtCodCurso")))
        );
        
        $this->cursos->inserirModulo($parametros);

        $_SESSION["msg_ok"] = "Módulo inserido com sucesso";
        redirect(base_url("index.php/modulo/getModulos/"));
    }
    
    public function delete(){
        
        $cod = intval(trim(filter_input(INPUT_POST, "cod")));
        
        $this->db->where("codItem", $cod)->delete("itens_contrataveis");
    }
    
    public function updateStatus(){
        
        $cod = intval(trim(filter_input(INPUT_POST, "cod")));
        $status = intval(trim(filter_input(INPUT_POST, "novoStatus")));
        
        $this->db->where("codItem", $cod)->update("itens_contrataveis", array("status" => $status));
        
        switch($status){
            case -1: 
                $_SESSION["msg_ok"] = "Módulo deletado";
                break;
            case 0:
                $_SESSION["msg_ok"] = "Módulo Inativado";
                break;
            case 1: 
                $_SESSION["msg_ok"] = "Módulo Ativo novamente";
                break;
        }
                
    }

}
