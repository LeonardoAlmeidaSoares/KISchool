<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tipocurso extends CI_Controller {

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
        
        $this->load->Model("Model_cursos", "cursos");
    }

    public function index() {
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "lista" => $this->cursos->getListaTipoCursos()
        );

        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('tipocurso/listarTipoCurso', $parametros);
        $this->load->view('inc/footer');
    }

    public function novo() {
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('tipocurso/inserirTipoCurso');
        $this->load->view('inc/footer');
    }

    public function inserir() {

        /*Tem que testar essa merda*/
        
        $nomecerto_cadastrar = "";
        
        if (!empty($_FILES['txtIcone']['name'])) {
            $imagem = explode(".", $_FILES['txtIcone']['name']);
            $comp = date('Y-m-d_HHiiss');
            $nomecerto_cadastrar = CAMINHO_IMAGENS_ICONES . $imagem[0] . $comp . '.' . $imagem[1];
            $uploadfile = dirname(getcwd()) . "/bancoImagens/galeria/" . $imagem[0] . $comp . '.' . $imagem[1];
            $parametros["capa"] = $nomecerto_cadastrar;
            move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
        }
        
        /*Até aqui tem que testar (essa merda)*/
        
        $parametros = array(
            "nome" => trim(filter_input(INPUT_POST, "txtNome")),
            "descricao" => trim(filter_input(INPUT_POST, "txtDescricao")),
            "icone" => $uploadfile,
            "status" => 0
        );
        $this->cursos->inserirTipo($parametros);
        redirect(base_url("index.php/tipocurso/"));
    }

}
