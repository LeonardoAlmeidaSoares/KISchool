<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vagas extends CI_Controller {

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

        $this->load->Model("Model_vagas", "vagas");
    }

    public function index() {
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "lista" => $this->vagas->getListaTipoCursos()
        );

        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('vagas/listarVagas', $parametros);
        $this->load->view('inc/footer');
    }

    public function novo() {
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('vagas/inserirVaga');
        $this->load->view('inc/footer');
    }

    public function inserir() {
        
        $parametros = array(
            "cargo" => trim(filter_input(INPUT_POST, "txtCargo")),
            "descricao" => trim(filter_input(INPUT_POST, "txtDescricao")),
            "cidade" => trim(filter_input(INPUT_POST, "txtCidade")),
            "status" => 0
        );
        $this->vagas->inserirVaga($parametros);
        redirect(base_url("index.php/vagas/"));
    }
    
    public function delete(){
        
        $cod = intval(trim(filter_input(INPUT_POST, "cod")));
        
        $this->db->where("codVaga", $cod)->delete("vagas");
        
    }
    
    public function updateStatus(){
        
        $cod = intval(trim(filter_input(INPUT_POST, "cod")));
        $status = intval(trim(filter_input(INPUT_POST, "novoStatus")));
        
        $this->db->where("codVaga", $cod)->update("vagas", array("status" => $status));
    }

}
