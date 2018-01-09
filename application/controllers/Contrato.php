<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contrato extends CI_Controller {

    function __construct() {

        parent::__construct();

        session_start();

        if (!isset($_SESSION["user_data"])) {
            redirect(base_url("index.php/login/"));
        }

        if ($_SESSION["perm_data"]->perm_direcao == 0) {
            $_SESSION["msg_err"] = "Voce não pode acessar essa tela :/";
            redirect(base_url());
        }

        //$this->load->Model("Model_cursos_oferecidos", "cursos");
    }

    public function cancelamentosPendentes(){
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "lista" => $this->db->get_where("aluno", array("status" => STATUS_ALUNO_CANCELAMENTO_PENDENTE))
        );
        
        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('alunos/listarAlunos', $parametros);
        $this->load->view('inc/footer');
        
    }
    
    
}