<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_permissao extends CI_Model {

    public function getPermissoesUsuario($codUsuario) {
        return $this->db->get_where("usuario_permissao", array("codUsuario" => $codUsuario));
    }
 
    public function getPermissoes($codInstituicao) {
        return $this->db->query(
                "select up.*, u.nome from usuario_permissao up "
                . "join usuario u on u.codUsuario = up.codUsuario "
                . "where u.codInstituicao = $codInstituicao and status = 1"
        );
    }
    
    public function alterar($cod, $parametros){
        $this->db->where("codUsuario", $cod)->update("usuario_permissao", $parametros);
    }
    
}