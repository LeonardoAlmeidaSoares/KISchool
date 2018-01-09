<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_professor extends CI_Model {

    public function getListaProfessores() {
        return $this->db->get_where("professor", array("status>" => -1));
    }
    
    public function getListaProfessoresAtivos() {
        return $this->db->get_where("professor", array("status" => 1));
    }
    
    public function inserir($parametros){
        
        $this->db->insert("professor", $parametros);
        
        $codProfessor = $this->db->insert_id();
        
        $this->db->insert("usuario", array(
            "email" => $parametros["email"],
            "nome" => $parametros["nome"],
            "senha" => $parametros["senha"],
            "status" => 1,
            "codInstituicao" => $_SESSION["inst_data"]->codInstituicao,
            "cargo" => "professor",
            "codCargo" => COD_CARGO_PROFESSOR,
            "codReferencia" => $codProfessor
        ));
        
        $codUser = $this->db->insert_id();
        
        return $this->db->insert("usuario_permissao", array(
            "codUsuario" => $codUser,
            "perm_alterarSite" => 0,
            "perm_turmas" => 1,
            "perm_professor" => 0,
            "perm_aluno" => 1,
            "perm_permissao" => 0,
            "perm_pagamento" => 0,
            "perm_cursos" => 0,
            "perm_salas" => 0,
            "perm_direcao" => 0
        ));
        
    }
    
    public function checarPendenciasPraDeletar($cod){
        
        $return = "OK";
        
        if($this->db->get_where("turma", array("codProfessor" => $cod, "status" => 1))->num_rows() > 0){
            $return = "Tem turmas vinculadas a esse professor ainda";
            return $return;
        }
        
        return $return;
    }
    
    public function getObservacoes($codProfessor){
        return $this->db->select("o.texto, p.nome, o.data, o.codObservacao, o.assunto")
                        ->from("observacao_professor o")
                        ->join("professor p", "p.codProfessor = o.codProfessor")
                        ->where("o.codProfessor", $codProfessor)
                        ->get();
    }
    
}
