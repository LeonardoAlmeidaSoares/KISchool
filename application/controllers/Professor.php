<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Professor extends CI_Controller {

    function __construct() {

        parent::__construct();

        session_start();

        if(!isset($_SESSION["user_data"])){
            redirect(base_url("index.php/login/"));
        }
        
        if($_SESSION["perm_data"]->perm_professor == 0){
            $_SESSION["msg_err"] = "Voce não pode acessar essa tela :/";
            redirect(base_url());
        }
        
        $this->load->Model("Model_professor", "prof");
    }

    public function index() {
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "lista" => $this->prof->getListaProfessores()
        );

        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('professor/listarProfessores', $parametros);
        $this->load->view('inc/footer');
    }

    public function novo() {
                
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('professor/inserirProfessor');
        $this->load->view('inc/footer');
    }

    public function inserir() {
        
        $parametros = array(
            "nome" => trim(filter_input(INPUT_POST, "txtNome")),
            "email" => trim(filter_input(INPUT_POST, "txtEmail")),
            "dataNascimento" => trim(filter_input(INPUT_POST, "txtNascimento")),
            "telefone" => trim(filter_input(INPUT_POST, "txtTelefone")),
            "senha" => md5(trim(filter_input(INPUT_POST, "txtSenha"))),
            "logradouro" => trim(filter_input(INPUT_POST, "txtLogradouro")),
            "complemento" => trim(filter_input(INPUT_POST, "txtComplemento")),
            "bairro" => trim(filter_input(INPUT_POST, "txtBairro")),
            "cidade" => trim(filter_input(INPUT_POST, "txtCidade")),
            "identidade" => trim(filter_input(INPUT_POST, "txtIdentidade")),
            "cpf" => trim(filter_input(INPUT_POST, "txtCpf")),
            "celular" => trim(filter_input(INPUT_POST, "txtCelular")),
            "areaLecionada" => trim(filter_input(INPUT_POST, "txtArea")),
            "salario" => doubleval(trim(filter_input(INPUT_POST, "txtSalario"))),
            "tipoSalario" => trim(filter_input(INPUT_POST, "txtTipoSalario")),
            "status" => 1
        );
        
        $parametros["dataNascimento"] = 
                substr($parametros["dataNascimento"], 6, 4) . "-" .
                substr($parametros["dataNascimento"], 3, 2) . "-" .
                substr($parametros["dataNascimento"], 0, 2);
        
        $this->prof->inserir($parametros);
        
        $_SESSION["msg_ok"] = "Cadastro realizado com sucesso";
        
        redirect(base_url("index.php/professor/"));
    }

    public function delete(){
        
        $cod = intval(trim(filter_input(INPUT_POST, "cod")));
        
        $this->db->where("codProfessor", $cod)->delete("professor");
        
    }
    
    public function updateStatus(){
        
        $cod = intval(trim(filter_input(INPUT_POST, "cod")));
        $status = intval(trim(filter_input(INPUT_POST, "novoStatus")));
        
        $just_do_it = true; $retorno = "";
        
        if($status == -1){
            $retorno = $this->prof->checarPendenciasPraDeletar($cod);
            $just_do_it = $retorno == "OK";
        }
        
        if($just_do_it){
            $this->db->where("codProfessor", $cod)->update("professor", array("status" => $status));
        }
        
        echo $retorno; 
        
    }
    
    public function observacao($codProfessor) {
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "lista" => $this->prof->getObservacoes($codProfessor),
            "codProfessor" => $codProfessor
        );

        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('professor/observacoes', $parametros);
        $this->load->view('inc/footer');
    }
    
}
