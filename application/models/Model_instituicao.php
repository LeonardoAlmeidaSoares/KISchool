<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_instituicao extends CI_Model {

    public function getInstituicoes() {
        return $this->db->get_where("instituicao", array("status" => 1));
    }
    

}
