<?php

class Observacao extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        session_start();       
        
    }

    public function NovaObservacao(){
                
        $parametrosBarra = array(
            "listaNotificacoes" => $this->notif->getNotificacoes()
        );
        
        $codAluno = intval(trim(filter_input(INPUT_POST, "codigo")));
        
        $parametros = array(
            "dadosAluno" => $this->db->get_where("aluno", array("codAluno" => $codAluno, "status" => COD_STATUS_OBSERVACAO_ATIVA))->row(0)
        );
        
        $this->load->view("observacao/novo", $parametros);
    }
    
    public function cadastrar(){
        
        $codigo = intval(trim(filter_input(INPUT_POST, "codigo")));
        $mensagem = trim(filter_input(INPUT_POST, "msg"));
        $assunto = trim(filter_input(INPUT_POST, "assunto"));
        $tipo = trim(filter_input(INPUT_POST, "tipo"));
        
        $table = "";
        
        $parametros = array(
            "texto" => $mensagem,
            "codUsuario" => $_SESSION["user_data"]->codUsuario,
            "status" => COD_STATUS_OBSERVACAO_ATIVA,
            "assunto" => $assunto
        );
        
        if($tipo == "P"){
            $parametros["codProfessor"] = $codigo;
            $table = "observacao_professor";
        }else{
            $parametros["codAluno"] = $codigo;
            $table = "observacao_aluno";
        }
                
        $aux = $this->db->insert($table, $parametros);
        
        $ret = array(
            "type" => ($aux) ? "success" : "error",
            "message" => ($aux) ? "Observação Cadastrada Com Sucesso" : "Houve um Erro",
            "title" => ($aux) ? "Deu Certo" : "Desculpe, mas ..."
        );
        
        echo json_encode($ret);
        
    }
    
    public function leituraObservacaoAluno(){
        
        $codObservacao = intval(trim(filter_input(INPUT_POST, "codigo")));
        
        $dados = $this->db->select("DATE_FORMAT(oa.data,'%d/%m/%Y') as data, oa.texto, u.nome")
                ->from("observacao_aluno oa")
                ->join("usuario u", "u.codUsuario = oa.codUsuario")
                ->where("codObservacao", $codObservacao)
                ->get();
        
        echo json_encode($dados->result_array());
        
    }
    
    public function leituraObservacaoProfessor(){
        
        $codObservacao = intval(trim(filter_input(INPUT_POST, "codigo")));
        
        $dados = $this->db->select("DATE_FORMAT(op.data,'%d/%m/%Y') as data, op.texto, p.nome")
                ->from("observacao_professor op")
                ->join("professor p", "p.codProfessor = op.codProfessor")
                ->where("codObservacao", $codObservacao)
                ->get();
        
        echo json_encode($dados->result_array());
        
    }
    
    public function inativar(){

        $codigos = $_POST["codigos"];
        
        $parametros = array(
            "status" => COD_STATUS_OBSERVACAO_CANCELADA,
            "dataCancelamento" => date("Y-m-d H:i:s"),
            "responsavelCancelamento" => $_SESSION["user_data"]->codUsuario
        );
        
        foreach($codigos as $item){
            //$this->db->where("codObservacao", $item)->update("observacao_aluno", $parametros);
        }
        
    }
    
}