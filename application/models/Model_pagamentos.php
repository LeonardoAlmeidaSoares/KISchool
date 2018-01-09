<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pagamentos extends CI_Model {

    public function getListaPagamentos($codInstituicao) {
        return $this->db->select("p.codPagamento, c.codContrato, r.nome, r.telefone, a.nome, p.valor, p.dataVencimento, DATE_FORMAT(p.dataVencimento, '%d/%m/%Y') as Vencimento,"
                . "DATE_FORMAT(p.dataPagto, '%d/%m/%Y') as dataPagto, p.status, p.desconto")
                ->from("pagamento p")
                ->join("contrato c", "c.codContrato = p.codContrato")
                ->join("aluno a", "a.codAluno = c.codAluno")
                ->join("responsavel r", "r.codResponsavel = a.codResponsavel")
                ->where("p.codInstituicao", $codInstituicao)
                ->order_by("p.dataVencimento")
                ->get();
    }
    
    public function getListaPagamentosAluno($codAluno) {
        return $this->db->select("p.codPagamento, c.codContrato, r.nome, r.telefone, a.nome, p.valor, DATE_FORMAT(p.dataVencimento, '%d/%m/%Y') as Vencimento, p.status")
                ->from("pagamento p")
                ->join("contrato c", "c.codContrato = p.codContrato")
                ->join("aluno a", "a.codAluno = c.codAluno")
                ->join("responsavel r", "r.codResponsavel = a.codResponsavel")
                ->where("a.codAluno", $codAluno)
                ->order_by("p.dataVencimento")
                ->get();
    }
    
    public function getListaPagamentosAtrasados($codInstituicao) {
        return $this->db->select("p.codPagamento, c.codContrato, r.nome, r.telefone, a.nome, p.valor, p.desconto, "
                . "DATE_FORMAT(p.dataVencimento, '%d/%m/%Y') as Vencimento, p.dataVencimento, p.dataPagto, p.status")
                ->from("pagamento p")
                ->join("contrato c", "c.codContrato = p.codContrato")
                ->join("aluno a", "a.codAluno = c.codAluno")
                ->join("responsavel r", "r.codResponsavel = a.codResponsavel")
                ->where("p.dataVencimento < NOW()", NULL)
                ->where("p.codInstituicao", $codInstituicao)
                ->where("p.status",0)
                ->order_by("p.dataVencimento")
                ->get();
    }
    
    public function montarBoleto($codPagamento){
        
        return $this->db->select("p.descricao, p.valor, p.dataVencimento, r.nome, r.logradouro, r.cidade, r.cep, p.numParcela")
                ->from("pagamento p")
                ->join("contrato c", "c.codContrato = p.codContrato")
                ->join("responsavel r", "r.codResponsavel = c.codResponsavel")
                ->where("p.codPagamento", $codPagamento)
                ->get();
        
    }
    

}
