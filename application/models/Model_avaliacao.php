<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_avaliacao extends CI_Model {

    public function getListagem($codTurma) {
        
        return $this->db->get_where("avaliacao", array("codTurma" => $codTurma));
    }
    
    public function get($codAvaliacao){
        return $this->db->get_where("avaliacao", array("codAvaliacao" => $codAvaliacao));
    }
    
}