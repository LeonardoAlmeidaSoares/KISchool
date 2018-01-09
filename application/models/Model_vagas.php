<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_vagas extends CI_Model {

    public function getListaTipoCursos() {
        return $this->db->get("vagas");
    }
    
    public function inserirVaga($parametros){
        $this->db->insert("vagas", $parametros);
    }

}
