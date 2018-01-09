<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_cursos extends CI_Model {

    public function getListaTipoCursos() {
        return $this->db->get("tipo_curso");
    }
    
    public function getListaCursos() {
        return $this->db->get("cursos_oferecidos");
    }
    
    public function inserirTipo($parametros){
        $this->db->insert("tipo_curso", $parametros);
    }
    
    public function inserirCurso($parametros){
        $this->db->insert("curso", $parametros);
    }

}
