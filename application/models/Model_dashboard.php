<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_dashboard extends CI_Model {

    public function getMatriculasNoMes() {
        return $this->db->query("select count(*) as qtd from contrato where MONTH(data) = MONTH(NOW())");
    }

    public function getAniversariantes() {
        return $this->db->query("select count(*) as qtd from (
                                    select codAluno as Codigo  from aluno a where DATE_FORMAT(nascimento, '%d/%m') = DATE_FORMAT(CURDATE(), '%d/%m') 
                                UNION 
                                    select codProfessor from professor p where DATE_FORMAT(dataNascimento, '%d/%m') = DATE_FORMAT(CURDATE(), '%d/%m')
                                ) as T");
    }

    public function getListaAlunosParaLigar($codInstituicao){
        return $this->db->query("select * from aluno where status in (" . STATUS_ALUNO_FALTOSO . "," . STATUS_ALUNO_ABANDONOU . ")");
    }
    
    public function getGraficoInadimplenciaMesAtual() {
        return $this->db->query("SELECT count(*) as qtd, status from pagamento
                                        where MONTH(dataVencimento) = MONTH(CURDATE())
                                    group by status");
    }

    public function getAlunosAniversariantesSalaProfessor($codProfessor) {
        return $this->db->query("select * from aluno a 
                                    join aluno_turma at on at.codAluno = a.codAluno
                                    join turma t on t.codTurma = at.codTurma
                                    where t.codProfessor = $codProfessor and 
                                    DATE_FORMAT(nascimento,'%m/%d') = DATE_FORMAT(CURDATE(),'%m/%d')");
    }
    
    public function BoletosAtrasados($codInstituicao){
        return $this->db->query("SELECT * FROM pagamento where dataVencimento < NOW() and status = 0 and codInstituicao = $codInstituicao");
    }
    
    public function getQuantidadeAlunos($codProfessor) {
        return $this->db->query(
            "select * from aluno_turma at where at.codTurma in (select codTurma from turma where codProfessor = $codProfessor)"
        );
    }

    public function getGraficoPresencaAlunos($codTurma) {
        
        return $this->db->query("select count(*), a.nome, mc.status, a.codAluno  
                from aluno a join aluno_turma at on at.codAluno = a.codAluno
                join turma t on t.codTurma = at.codTurma
                join marcacao_chamada mc on mc.codAluno = a.codAluno
                where t.codTurma = $codTurma group by mc.status, a.codAluno");
    }
    
    public function getGraficoMatriculaxRescisao($inicio, $fim){
        
        if(is_null($inicio)){
            $inicio = date("Y-m-01");
            $fim = date("Y-m-d");
        }
        
        return $this->db->query("select (select count(*) from contrato c where c.data BETWEEN '$inicio' AND '$fim') as Matriculas, "
                . "(select count(*) from cancelamento c where c.data BETWEEN '$inicio' AND '$fim') as Cancelamento");
    }

}
