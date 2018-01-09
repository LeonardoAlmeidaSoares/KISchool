<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_aluno extends CI_Model {

    public function getListaAlunos() {
        
        return $this->db->select("a.*, c.codContrato")
                ->from("aluno a")
                ->join("contrato c", "c.codAluno = a.codAluno")
                ->where("a.status>", STATUS_ALUNO_CANCELAMENTO_PENDENTE)
                ->get();
    }

    public function getMatricula(){
        $id = $this->db->query("select CONCAT(DATE_FORMAT(NOW(),'%y'), (SELECT LPAD(COUNT(*) + 1,4,'0') FROM ALUNO WHERE YEAR(dataCadastro) = YEAR(NOW()))) as id");
        return $id->row(0)->id;
    }

    public function getAluno($codAluno) {
        return $this->db->get_where("aluno", array("codAluno" => $codAluno));
    }

    public function getListaAlunosFaltosos() {
        return $this->db->get_where("aluno", array("status" => STATUS_ALUNO_FALTOSO));
    }

    public function CadastrarRepresentante($parametros) {
        if(isset($parametros["codResponsavel"])){
             return $this->db->insert("responsavel", $parametros);
        }else
        {
             $this->db->insert("responsavel", $parametros);
             return $this->db->insert_id();
        }
    }

    public function getResponsavel($codresponsavel) {
        return $this->db->get_where("responsavel", array("codResponsavel" => $codresponsavel));
    }

    public function Cadastrar($parametros) {
        return $this->db->insert("aluno", $parametros);
    }

    public function checkAlunoFaltoso($codAluno, $limite) {
        $ret = $this->db->query("select sum(status) as qtd from (select status from marcacao_chamada where codAluno = $codAluno order by codChamada desc limit $limite) t1");
        if ($ret->row(0)->qtd == 0) {
            $this->db->where("codAluno", $codAluno)->update("aluno", array("status" => STATUS_ALUNO_FALTOSO));
        }
    }
    
    public function checkAlunoAbandono($codAluno, $limite, $codTurma) {
        $ret = $this->db->query("select sum(status) as qtd from (select status from marcacao_chamada where codAluno = $codAluno order by codChamada desc limit $limite) t1");
        if ($ret->row(0)->qtd == 0) {
            $this->db->where("codAluno", $codAluno)->update("aluno", array("status" => STATUS_ALUNO_ABANDONOU));
            $this->db->where("codTurma", $codTurma)->set('numVagas', 'numVagas+1', FALSE)->update("turma");
            $this->db->where("codAluno", $codAluno)->where("codTurma", $codTurma)->update("aluno_turma", array("status" => STATUS_ALUNO_VAGA_LIBERADA));
        }
    }

    public function getListaAlunosAniversariantes() {
        return $this->db->query("select codAluno as Codigo, nome, telefone, 'Aluno' as Funcao, nascimento, email 
            from aluno where DATE_FORMAT(nascimento, '%d/%m') = DATE_FORMAT(CURDATE(), '%d/%m')
                UNION
            select codProfessor, nome, celular, 'Professor' as Funcao, dataNascimento, email
            from professor where DATE_FORMAT(dataNascimento, '%d/%m') = DATE_FORMAT(CURDATE(), '%d/%m')");
    }

    public function getFrequencia($codAluno) {
        return $this->db->select("count(*) as qtd, status")
                        ->from("marcacao_chamada")
                        ->where("codAluno", $codAluno)
                        ->group_by("status")
                        ->get();
    }

    public function getCertifados($codAluno) {
        return $this->db->select("ac.status, ac.dataEmissaoCertificado, ic.descricao, ac.dataEntregaCertificado, ac.nomeResponsavelPegouComprovante, ac.codAluno, ac.codModulo")
                        ->from("aluno_certificado ac")
                        ->join("itens_contrataveis ic", "ac.codModulo = ic.codItem")
                        ->where("ac.codAluno", $codAluno)
                        ->get();
    }

    public function getCertifadoDetalhado($codAluno, $codModulo) {
        return $this->db->select("ic.descricao, ac.status")
                        ->from("aluno_certificado ac")
                        ->join("itens_contrataveis ic", "ac.codModulo = ic.codItem")
                        ->where("ac.codAluno", $codAluno)
                        ->where("ic.codItem", $codModulo)
                        ->get();
    }

    public function getObservacoes($codAluno) {
        return $this->db->select("o.texto, u.nome, o.data, o.codObservacao, o.assunto")
                        ->from("observacao_aluno o")
                        ->join("usuario u", "u.codUsuario = o.codUsuario")
                        ->where("o.codAluno", $codAluno)
                        ->get();
    }

    public function getDetalhesAluno($codAluno) {
        return $this->db->get_where("detalhesAluno", array("codAluno" => $codAluno));
    }

    public function getFaltas($codAluno) {
        return $this->db->query("select "
                        . "(select count(*) from marcacao_chamada where codAluno=$codAluno) as 'Aulas', "
                        . "(select sum(status) from marcacao_chamada where codAluno=$codAluno) as 'Presencas', "
                        . "(select count(*)-sum(status) from marcacao_chamada where codAluno=$codAluno) as Ausencias");
    }

    public function getResumoAcademicoByCicloLetivo($codAluno) {
        return $this->db->query("SELECT count(mc.status) as 'Aulas', sum(mc.status) as 'Presenças', (count(mc.status) - sum(mc.status)) as 'Ausencias', i.descricao
                                from marcacao_chamada mc
                                join chamada c on c.codChamada = mc.codChamada
                                inner join ciclo_letivo cl on cl.codCicloLetivo = c.codCiclo
                                join itens_contrataveis i on i.codItem = cl.codModulo
                                where mc.codAluno = $codAluno
                                group by cl.codCicloLetivo");
    }
    
    public function getResumoAcademicoDetalhado($codAluno){
        return $this->db->query("select (m.duracao * 30) as 'TotalDias', cl.inicio, m.descricao, DATEDIFF(NOW(), cl.inicio) as 'DiasPercorridos', ac.status, m.codItem
                        from ciclo_letivo cl
                        inner join itens_contrataveis m on m.codItem = cl.codModulo
                        left join aluno_certificado ac on ac.codAluno = $codAluno and ac.codModulo = m.codItem
                        where codTurma = (select codTurma from aluno_turma where codAluno = $codAluno) order by m.codItem");
    }
    
    public function getPresencasPorCiclo($codAluno){
        return $this->db->query("select sum(mc.status) as 'Presencas', count(*) as 'TotalAulas', ic.descricao 
                                from marcacao_chamada mc
                                inner join chamada c on c.codChamada = mc.codChamada
                                inner join ciclo_letivo cl on cl.codCicloLetivo = c.codCiclo
                                inner join itens_contrataveis ic on ic.codItem = cl.codModulo
                                where mc.codAluno = $codAluno
                                group by ic.codItem");
    }

    public function getListaAlunosParaLigar($codInstituicao){
        return $this->db->query("select * from aluno where status in (" . STATUS_ALUNO_FALTOSO . "," . STATUS_ALUNO_ABANDONOU . ")");
    }
    
    public function getAlunosProfessor($codProfessor){
 
        return $this->db->select("a.*")
                ->from("aluno a")
                ->join("aluno_turma at", "at.codAluno  = a.codAluno")
                ->join("turma t", "t.codTurma = at.codTurma")
                ->where("t.codProfessor", $codProfessor)
                ->get();
    }
    
    public function getTurmaAluno($codAluno){
        return $this->db->select("t.*")
                ->from("turma t")
                ->join("aluno_turma at", "at.codTurma = t.codTurma")
                ->where("at.codAluno", $codAluno)
                ->where("at.status", 1)
                ->get();
    }
    
    public function getCertificadoFinal($codAluno){
        
        $codCertificado = $this->db->query("select IF(
		((SELECT COUNT(*) FROM aluno_certificado where codAluno = $codAluno) = 
                (SELECT COUNT(*) FROM itens_contrataveis where codCurso = (select codCurso from contrato where codAluno = $codAluno))),
        (select codCurso from contrato where codAluno = $codAluno), NULL
	) as GerarCertificadoParaCursoDeID")->row(0)->GerarCertificadoParaCursoDeID;
        
        return (is_null($codCertificado)) ? NULL : $this->db->get_where("cursos_oferecidos", array("codCurso" => $codCertificado));
    }
    
    //public function getAprovacao()
}
