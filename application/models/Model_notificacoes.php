<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_notificacoes extends CI_Model {
    
    public function getNotificacoes(){
        return $this->db->get_where("notificacao", array("status" => COD_NOTIFICACAO_ABERTA));
    }
    
    public function get($cod){
        return $this->db->get_where("notificacao", array("codModulo" => $cod));
    }
    
}