<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    function __construct() {

        parent::__construct();

        session_start();

        if (!isset($_SESSION["user_data"])) {
            redirect(base_url("index.php/login/"));
        }

        $this->load->Model("Model_dashboard", "dash");
    }
    
    public function index() {
        
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        switch ($_SESSION["user_data"]->codCargo) {

            case 1:
                
                $parametros = array(
                    "numMatriculas" => $this->dash->getMatriculasNoMes()->row(0)->qtd,
                    "numAniversariantes" => $this->dash->getAniversariantes()->row(0)->qtd,
                    "numAlunosFaltosos" => $this->dash->getListaAlunosParaLigar($_SESSION["inst_data"]->codInstituicao)->num_rows(),
                    "numBoletosAtrasados" => $this->dash->BoletosAtrasados($_SESSION["inst_data"]->codInstituicao),
                    "graficoInadimplenciaMesAtual" => $this->dash->getGraficoInadimplenciaMesAtual(),
                    "graficoMatriculasxRescisoes" => $this->dash->getGraficoMatriculaxRescisao(NULL, NULL)
                );

                $this->load->view('inc/header');
                $this->load->view("inc/barra", $parametrosBarra);
                $this->load->view("inc/menu");
                $this->load->view('outros/dashboardDono', $parametros);
                $this->load->view('inc/footer');
                break;
            
            case 3:
                
                $parametros = array(
                    "numMatriculas" => $this->dash->getMatriculasNoMes()->row(0)->qtd,
                    "numAniversariantes" => $this->dash->getAniversariantes()->row(0)->qtd,
                    "numAlunosFaltosos" => $this->db->get_where("aluno", array("status" => STATUS_ALUNO_FALTOSO))->num_rows(),
                    "numBoletosAtrasados" => $this->dash->BoletosAtrasados($_SESSION["inst_data"]->codInstituicao),
                    "graficoInadimplenciaMesAtual" => $this->dash->getGraficoInadimplenciaMesAtual()
                );
                
                $this->load->view('inc/header');
                $this->load->view("inc/barra", $parametrosBarra);
                $this->load->view("inc/menu");
                $this->load->view('outros/dashboardDono', $parametros);
                $this->load->view('inc/footer');
                break;
            
            case 4:
                
                $parametros = array(
                    "numTurmas" => $this->db->get_where("turma", array("codProfessor" => $_SESSION["user_data"]->codReferencia))->num_rows(),
                    "aniversariantes" => $this->dash->getAlunosAniversariantesSalaProfessor($_SESSION["user_data"]->codReferencia)->num_rows(),
                    "alunos" => $this->dash->getQuantidadeAlunos($_SESSION["user_data"]->codReferencia)->num_rows(),
                    //"turmas" => $this->dash->getGraficoPresencaAlunos()
                );

                $turmas = $this->db->get_where("turma", array("codProfessor" => $_SESSION["user_data"]->codReferencia, "status" => 1));
                $t_alunos = array(); $cont = 0;
                
                foreach($turmas->result() as $item){
                    $t_alunos[++$cont] = $this->dash->getGraficoPresencaAlunos($item->codTurma);
                }
                
                $parametros["turmas"] = $t_alunos;
                
                $this->load->view('inc/header');
                $this->load->view("inc/barra", $parametrosBarra);
                $this->load->view("inc/menu");
                $this->load->view('outros/dashboardProfessor', $parametros);
                $this->load->view('inc/footer');
                break;
            
            case 5:

                $parametros = array(
                    "numMatriculas" => $this->dash->getMatriculasNoMes()->row(0)->qtd,
                    "numAniversariantes" => $this->dash->getAniversariantes()->row(0)->qtd,
                    "numAlunosFaltosos" => $this->db->get_where("aluno", array("status" => STATUS_ALUNO_FALTOSO))->num_rows(),
                    "numBoletosAtrasados" => $this->dash->BoletosAtrasados($_SESSION["inst_data"]->codInstituicao),
                    "graficoInadimplenciaMesAtual" => $this->dash->getGraficoInadimplenciaMesAtual()
                );
                
                $this->load->view('inc/header');
                $this->load->view("inc/barra", $parametrosBarra);
                $this->load->view("inc/menu");
                $this->load->view('outros/dashboardDono', $parametros);
                $this->load->view('inc/footer');
                break;
                            
        }
    }

}
