<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_contas_pagar extends CI_Model {
    
    public function getListaContas($codEmpresa){
        
        return $this->db->select("p.descricao, p.codContaPagar, p.status, c.descricao as Categoria, "
                . "p.valor, p.dataVencimento, p.observacao, p.dataPagto")
                ->from("conta_pagar p")
                ->join("categoriacontapagar c", "c.codCategoriaContaPagar = p.codCategoriaContaPagar")
                ->where("p.codInstituicao", $codEmpresa)
                ->where("p.status>", COD_CONTA_PAGAR_CANCELADA)
                ->get();
                
    }
    
    public function inserir($parametros){
        return $this->db->insert("conta_pagar", $parametros);
    }
    
}