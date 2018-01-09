<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ContasPagar extends CI_Controller {

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
        
        $this->load->Model("Model_contas_pagar", "contas");
    }
    
    public function index() {
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "lista" => $this->contas->getListaContas($_SESSION["inst_data"]->codInstituicao)
        );
        
        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('contasPagar/listagem', $parametros);
        $this->load->view('inc/footer');
    }
    
    public function novo(){
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        $parametros = array(
            "dados" => $this->db->get_where("categoriacontapagar", array("status" => 1))
        );
        
        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('contasPagar/cadastrar', $parametros);
        $this->load->view('inc/footer');
        
    }
    
    public function inserir(){
        
        $parametros = array(
            "descricao" => trim(filter_input(INPUT_POST, "txtDescricao")),
            "valor" => doubleval(trim(str_replace(",",".", str_replace(".","", filter_input(INPUT_POST, "txtValor"))))),
            "dataCriacao" => date("Y-m-d"),
            "dataVencimento" => trim(filter_input(INPUT_POST, "txtVencimento")),
            "observacao" => trim(filter_input(INPUT_POST, "txtObservacao")),
            "status" => COD_CONTA_PAGAR_A_VENCER,
            "codCategoriaContaPagar" => intval(trim(filter_input(INPUT_POST, "codCategoriaContaPagar"))),
            "codInstituicao" => $_SESSION["inst_data"]->codInstituicao
        );
        
        $parametros["dataVencimento"] = 
                substr($parametros["dataVencimento"], 6, 4) . "-" .
                substr($parametros["dataVencimento"], 3, 2) . "-" .
                substr($parametros["dataVencimento"], 0, 2);
        
        $this->contas->inserir($parametros);
        
        $_SESSION["msg_ok"] = "Cadastro realizado com sucesso";
        
        redirect(base_url("index.php/ContasPagar/"));
        
    }
    
    public function delete(){
        
        $cod = intval(trim(filter_input(INPUT_POST, "cod")));
        $this->db->where("codContaPagar", $cod)->update("conta_pagar", array("status"=> COD_CONTA_PAGAR_CANCELADA));
        
        $_SESSION["msg_ok"] = "Cancelamento realizado com sucesso";
        
    }
    
    public function AlterarStatus(){
        
        $cod = intval(trim(filter_input(INPUT_POST, "cod")));
        $this->db->where("codContaPagar", $cod)->update("conta_pagar", array("status"=> COD_CONTA_PAGAR_PAGO));
        
        $_SESSION["msg_ok"] = "Pagamento cadastrado com sucesso";
        
    }
    
}