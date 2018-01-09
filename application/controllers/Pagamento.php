<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pagamento extends CI_Controller {

    function __construct() {

        parent::__construct();

        session_start();

        if(!isset($_SESSION["user_data"])){
            redirect(base_url("index.php/login/"));
        }
        
        if($_SESSION["perm_data"]->perm_pagamento == 0){
            $_SESSION["msg_err"] = "Voce não pode acessar essa tela :/";
            redirect(base_url());
        }
        
        $this->load->Model("Model_pagamentos", "pagto");
    }

    public function index() {
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "lista" => $this->pagto->getListaPagamentos($_SESSION["inst_data"]->codInstituicao)
        );
        
        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('pagamento/listagem', $parametros);
        $this->load->view('inc/footer');
    }
    
    public function atrasados(){
                
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "lista" => $this->pagto->getListaPagamentosAtrasados($_SESSION["inst_data"]->codInstituicao)
        );
        
        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('pagamento/listagem', $parametros);
        $this->load->view('inc/footer');
        
    }
    
    public function delete(){
        
        $cod = intval(trim(filter_input(INPUT_POST, "cod")));
        
        $this->db->where("codPagamento", $cod)->delete("pagamento");
        
    }
    
    public function updateStatus(){
        
        $cod = intval(trim(filter_input(INPUT_POST, "cod")));
        $status = intval(trim(filter_input(INPUT_POST, "novoStatus")));
        
        $this->db->where("codPagamento", $cod)->update("pagamento", array("status" => $status));
    }
    
    public function criarDesconto(){
        
        $codPagamento = intval(trim(filter_input(INPUT_POST, 'cod')));
        $valor = doubleval(trim(filter_input(INPUT_POST, "valor")));
        
        $this->db->query("update pagamento set desconto = (desconto + $valor) where codPagamento = $codPagamento");
        
        
    }
    
}