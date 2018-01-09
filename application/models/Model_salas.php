<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_salas extends CI_Model {

    public function getListadeSalas($codInstituicao) {
        return $this->db->get_where("sala", array("status>" => -1, "codInstituicao" => $codInstituicao));
    }
    
    public function inserirSala($parametros){
        $this->db->insert("sala", $parametros);
    }
    
    public function getSala($codSala){
        return $this->db->get_wehre("sala", array("codSala" => $codSala));
    }
    
    public function getSalaByTurma($codTurma){
        return $this->db->query("select * from sala where codSala = (select codSala from turma_sala where codTurma = $codTurma)");
    }
    
    public function getDetalhamento($codSala){
        return $this->db->select("s.*, t.descricao as turma, ts.horario, t.diaLetivo")
                ->from("sala s")
                ->join("turma_sala ts", "ts.codSala = s.codSala")
                ->join("turma t", "t.codTurma = ts.codTurma")
                ->where("s.codSala", $codSala)
                ->get();
    }
    
    public function setarSala($parametros){
        
        $ret = $this->db->get_where("turma_sala", array("codTurma" => $parametros["codTurma"]));
        
        if($ret->num_rows() == 0){
            $parametros["horario"] = $this->db->get_where("turma", array("codTurma" => $parametros["codTurma"]))->row(0)->horario;
            $parametros["status"] = 1;
            $this->db->insert("turma_sala", $parametros);
        }else{
            $this->db->where("codTurma", $parametros["codTurma"])->update("turma_sala", $parametros);
        }
        
        
    }
}
