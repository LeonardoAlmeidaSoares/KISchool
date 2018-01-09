<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_cursos_oferecidos extends CI_Model {

    public function getListaTipoCursos() {
        return $this->db->get("tipo_curso");
    }
    
    public function getListaCursos() {
        return $this->db->select("c.*, (select count(*) from itens_contrataveis i where i.codCurso = c.codCurso) as qtdModulos")
                ->from("cursos_oferecidos c")
                ->where("status>", -1)
                ->get();
    }
    
    public function inserirTipo($parametros){
        $this->db->insert("tipo_curso", $parametros);
    }
    
    public function inserirCurso($parametros){
        $this->db->insert("cursos_oferecidos", $parametros);
    }

    public function inserirModulo($parametros){
        $this->db->insert("itens_contrataveis", $parametros);
    }
    
}
