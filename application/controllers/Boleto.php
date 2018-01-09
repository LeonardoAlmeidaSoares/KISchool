<?php

class Boleto extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->library('BoletoPhp');
        
        $this->load->Model("Model_pagamentos", "pagto");
        $this->load->Model("Model_boleto", "m_boleto");
        
    }

    public function gerarBoleto($codPagamento) {
        
        $data = $this->pagto->montarBoleto($codPagamento)->row(0);
        
        $dados = array(
            // Informações necessárias para todos os bancos
            'dias_de_prazo_para_pagamento' => 5,
            //'taxa_boleto' => 1,
            'numero_parcela' => $data->numParcela,
            'pedido' => array(
                'nome' => 'Centro de Ensino Random',
                'quantidade' => '1',
                'valor_unitario' => number_format($data->valor, 2, ".","."),
                'numero' => date("y") . str_pad($codPagamento, 6, "0", STR_PAD_LEFT),
                'aceite' => 'N',
                'especie' => 'R$',
                'especie_doc' => 'DM',
            ),
            'sacado' => array(
                'nome' => $data->nome,
                'endereco' => $data->logradouro,
                'cidade' => $data->cidade,
                'uf' => "MG",
                'cep' => $data->cep,
            )
        );
        
        // Gera o boleto
        $this->boletophp->bancoob($dados);
    }
}
