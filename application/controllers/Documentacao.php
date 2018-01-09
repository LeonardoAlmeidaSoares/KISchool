<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Documentacao extends CI_Controller {

    function __construct() {

        parent::__construct();

        session_start();

        if(!isset($_SESSION["user_data"])){
            redirect(base_url("index.php/login/"));
        }
    }
    
    public function criarDocumentacao($codContrato){
                
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
        //    "dados" => $this->db->get_where("detalhesAluno", array("codContrato" => $codContrato))->row(0)
            "codContrato" => $codContrato
        );
        
        $this->load->view("inc/header");
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view("documentos/index", $parametros);
        $this->load->view("inc/footer");
    }
    
    public function rescisao($codContrato){
                
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "dados" => $this->db->get_where("detalhesAluno", array("codContrato" => $codContrato))->row(0),
            "debitos" => $this->db->get_where("pagamento", array("codContrato" => $codContrato)),
            "codAluno" => $codContrato
        );
        
        //var_dump($parametros["dados"]);
        
        $this->load->view("documentos/rescisao", $parametros);
    }
    
    public function trancamento($codContrato){
                
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "dados" => $this->db->get_where("detalhesAluno", array("codContrato" => $codContrato))->row(0),
            "codAluno" => $codContrato
        );
        
        $this->load->view("documentos/trancamento", $parametros);
    }
    
    public function acordo($codContrato){
                
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "dados" => $this->db->get_where("detalhesAluno", array("codContrato" => $codContrato))->row(0),
            "codAluno" => $codContrato
        );
        
        $this->load->view("documentos/acordo", $parametros);
    }
    
    public function declaracao($codContrato){
                
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $this->load->Model("Model_aluno", "aluno");
        
        $parametros = array(
            "dados" => $this->db->get_where("detalhesAluno", array("codContrato" => $codContrato))->row(0),
            "codAluno" => $codContrato,
        );
        
        $parametros["dadosTurma"] = $this->aluno->getTurmaAluno($parametros["dados"]->codAluno)->row(0);
        
        $this->load->view("documentos/declaracao", $parametros);
    }
    
}