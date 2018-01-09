<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {

        parent::__construct();

        session_start();

    }

    public function index() {
        $this->load->view('inc/header');
        $this->load->view('outros/login');
    }
    
    public function registrar(){
        
        $email = trim(filter_input(INPUT_POST,"txtEmail"));
        $senha = trim(filter_input(INPUT_POST,"txtSenha"));
        
        $ret = $this->db->get_where("usuario", array(
            "email" => $email,
            "senha" => md5($senha),
            "status" => 1
        ));
                
        if($ret->num_rows() > 0){
            
            $_SESSION["user_data"] = $ret->row(0);
            $_SESSION["inst_data"] = $this->db->get_where("instituicao", array("codInstituicao" => $ret->row(0)->codInstituicao))->row(0);
            $_SESSION["perm_data"] = $this->db->get_where("usuario_permissao", array("codUsuario" => $_SESSION["user_data"]->codUsuario))->row(0);
                                    
            redirect(base_url());
        }else{
            $_SESSION["msg"] = "Não encontrado";
            redirect(base_url("index.php/login/"));
        }
                
    }
    
    public function logout(){
        
        session_destroy();
        redirect( base_url() );
        
    }
    
}