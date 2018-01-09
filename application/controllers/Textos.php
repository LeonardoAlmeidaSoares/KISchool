<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Textos extends CI_Controller {

    function __construct() {

        parent::__construct();

        session_start();

        if(!isset($_SESSION["user_data"])){
            redirect(base_url("index.php/login/"));
        }
        
        if($_SESSION["perm_data"]->perm_alterarSite == 0){
            $_SESSION["msg_err"] = "Voce não pode acessar essa tela :/";
            redirect(base_url());
        }
        
        $this->load->Model("Model_textos", "textos");
    }

    public function index() {
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "textos" => $this->textos->getListaTextos()
        );

        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('textosAdministrativos/listarTextos', $parametros);
        $this->load->view('inc/footer');
    }

    public function alterar($codTexto) {
        
        $parametros = array(
            "texto" => trim(filter_input(INPUT_POST, "txtTexto"))
        );
        
        $this->db->where("codTexto", $codTexto)->update("textos_institucionais", $parametros);
        redirect(base_url("index.php/textos/"));
    }

}
