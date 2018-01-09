<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Util extends CI_Controller {

    function __construct() {
        parent::__construct();

        session_start();
        /*
        if (!isset($_SESSION["user_data"])) {
            redirect(base_url("index.php/login/"));
        }*/
    }

    public function getNotificacao(){
        
        $cod = trim(intval(filter_input(INPUT_POST, "cod")));
        
        $parametros = array(
            "status" => COD_NOTIFICACAO_FINALIZADA,
        );
        
        $this->db->where("codNotificacao", $cod)->update("notificacao", $parametros);
        
        $aux = $this->db->get_where("notificacao", array("codNotificacao" => $cod));
        echo json_encode($aux->result_array());
        
    }
    
    public function sendEmailAniversario(){
        
        // Carrega a library email
        $this->load->library('email');
         
        //Inicia o processo de configuração para o envio do email
        $config['protocol'] = 'mail'; // define o protocolo utilizado
        $config['wordwrap'] = TRUE; // define se haverá quebra de palavra no texto
        $config['validate'] = TRUE; // define se haverá validação dos endereços de email
         
        /*
         * Se o usuário escolheu o envio com template, define o 'mailtype' para html, 
         * caso contrário usa text
         */
            $config['mailtype'] = 'html';
        
        // Inicializa a library Email, passando os parâmetros de configuração
        $this->email->initialize($config);
        
        // Define remetente e destinatário
        $this->email->from('naoresponda@centrodeensinorandom.com.br', 'Centro de Ensino Random'); // Remetente
        $this->email->to('leonardoalmeidasoares23@gmail.com',"Léo"); // Destinatário
 
        // Define o assunto do email
        $this->email->subject('Feliz Aniversário');
 
        /*
         * Se o usuário escolheu o envio com template, passa o conteúdo do template para a mensagem
         * caso contrário passa somente o conteúdo do campo 'mensagem'
         */
            $this->email->message($this->load->view('email/emailAniversario',array(), TRUE));
         
        /*
         * Se foi selecionado o envio de um anexo, insere o arquivo no email 
         * através do método 'attach' da library 'Email'
         
        if(isset($dados['anexo']))
            $this->email->attach('./assets/images/unici/logo.png');
        */
        /*
         * Se o envio foi feito com sucesso, define a mensagem de sucesso
         * caso contrário define a mensagem de erro, e carrega a view home
         */
        if($this->email->send())
        {
            echo "Sucesso";
            //$this->session->set_flashdata('success','Email enviado com sucesso!');
            //$this->load->view('home');
        }
        else
        {
            echo $this->email->print_debugger();
            //$this->session->set_flashdata('error',$this->email->print_debugger());
            //$this->load->view('home');
        }
        
        
        //$this->load->view("email/Aniversariante");
    }
   
}