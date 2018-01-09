<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Permissao extends CI_Controller {

    function __construct() {

        parent::__construct();

        session_start();

        if (!isset($_SESSION["user_data"])) {
            redirect(base_url("index.php/login/"));
        }

        if($_SESSION["perm_data"]->perm_permissao == 0){
            $_SESSION["msg_err"] = "Voce não pode acessar essa tela :/";
            redirect(base_url());
        }
        
        $this->load->Model("Model_permissao", "perm");
    }
    
    public function index(){
                
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "lista" => $this->perm->getPermissoes($_SESSION["inst_data"]->codInstituicao)
        );

        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('permissao/listarPermissoes', $parametros);
        $this->load->view('inc/footer');
    }
    
    public function editar($cod){
                
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "lista" => $this->perm->getPermissoesUsuario($cod),
            "codUsuario" => $cod
        );

        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('permissao/editar', $parametros);
        $this->load->view('inc/footer');
    }
    
    public function salvar(){
        
        $codUsuario = intval(trim(filter_input(INPUT_POST, "codUsuario")));
        
        $parametros = array(
            "perm_alterarSite" => intval(trim(filter_input(INPUT_POST, "txtSite"))),
            "perm_turmas" => intval(trim(filter_input(INPUT_POST, "txtTurmas"))),
            "perm_professor" => intval(trim(filter_input(INPUT_POST, "txtProfessor"))),
            "perm_aluno" => intval(trim(filter_input(INPUT_POST, "txtAluno"))),
            "perm_permissao" => intval(trim(filter_input(INPUT_POST, "txtPermissao"))),
            "perm_pagamento" => intval(trim(filter_input(INPUT_POST, "txtPagamento"))),
            "perm_cursos" => intval(trim(filter_input(INPUT_POST, "txtCursos"))),
            "perm_salas" => intval(trim(filter_input(INPUT_POST, "txtSalas"))),
            "perm_direcao" => intval(trim(filter_input(INPUT_POST, "txtDiretoria")))
        );
        
        $this->perm->alterar($codUsuario, $parametros);
        
        $_SESSION["msg_ok"] = "Permissões alteradas com sucesso";
        
        redirect(base_url("index.php/permissao/"));
        
    }
    
}