<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cursooferecido extends CI_Controller {

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

    public function index() {
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "lista" => $this->cursos->getListaCursos()
        );

        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('cursos_oferecidos/listarCursos', $parametros);
        $this->load->view('inc/footer');
    }

    public function novo() {
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "lista" => $this->cursos->getListaTipocursos()
        );

        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('cursos_oferecidos/inserirCurso', $parametros);
        $this->load->view('inc/footer');
    }

    public function inserir() {

        $parametros = array(
            "nome" => trim(filter_input(INPUT_POST, "txtNome")),
            "valor" => doubleval(str_replace(",", ".", trim(filter_input(INPUT_POST, "txtValor")))),
            "status" => 0
        );
        $this->cursos->inserirCurso($parametros);
        redirect(base_url("index.php/cursoOferecido/"));
    }

    public function updateStatus() {

        $cod = intval(trim(filter_input(INPUT_POST, "cod")));
        $status = intval(trim(filter_input(INPUT_POST, "novoStatus")));

        $this->db->where("codCurso", $cod)->update("cursos_oferecidos", array("status" => $status));

        $_SESSION["msg_ok"] = ($status > -1) ? "Alteração realizada com sucesso" : "Deleção realizada com sucesso";
    }

    public function getModulos() {

        $codCurso = intval(trim(filter_input(INPUT_POST, "codCurso")));

        $retItens = $this->db->get_where("itens_contrataveis", array("codCurso" => $codCurso));
        $retorno = $retItens->result_array();

        $valorCurso = $this->db->get_where("cursos_oferecidos", array("codCurso" => $codCurso))->row(0)->valor;

        for ($i = 0; $i < count($retorno); $i++) {
            $retorno[$i]["valor"] = $valorCurso / count($retorno);
        }

        echo json_encode($retorno);
    }

    public function modulos($codCurso) {
                
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $parametros = array(
            "itens" => $this->db->get_where("itens_contrataveis", array("codCurso" => $codCurso)),
            "curso" =>$this->db->get_where("cursos_oferecidos", array("codCurso" => $codCurso))->row(0)
        );
                
        $this->load->view('inc/header');
        $this->load->view("inc/barra", $parametrosBarra);
        $this->load->view("inc/menu");
        $this->load->view('cursos_oferecidos/listarModulos', $parametros);
        $this->load->view('inc/footer');   
                
    }

}
