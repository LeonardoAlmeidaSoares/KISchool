<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_textos extends CI_Model {

    public function getListaTextos() {
        return $this->db->get("textos_institucionais");
    }
    
    //public function inserirTipo($parametros){
    //    $this->db->insert("tipo_curso", $parametros);
    //}

}
