<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_turma extends CI_Model {
    
    public function getLista() {
        return $this->db->select("t.*, c.nome as curso, (select count(*) from chamada where codCiclo = (select codCicloLetivo from ciclo_letivo where codTurma = t.codTurma and fim is null)) as NumAulas")
                ->from("turma t")
                ->join("cursos_oferecidos c", "c.codCurso = t.codCurso")
                ->where("t.status>", -1)
                ->get();
    }
    
    public function getListaTurmasProfessor($cod) {
        return $this->db->query("select t.*, c.nome as curso, (select count(*) from chamada where codCiclo = (select codCicloLetivo from ciclo_letivo where codTurma = t.codTurma and fim is null)) as NumAulas from turma t join cursos_oferecidos c on c.codCurso = t.codCurso where t.codProfessor = $cod and t.status >= 0");
    }
    
    public function getTurma($codTurma){
        return $this->db->get_where("turma", array("codTurma" => $codTurma));
    }
    
    public function inserirTurma($parametros){
        $this->db->insert("turma", $parametros);
    }
    
    public function listaAlunosAtivos($codTurma){
        return $this->db->query("select * from aluno a where codAluno in (select codAluno from aluno_turma where codTurma = $codTurma) and a.status > 0");
    }
    
    public function listaAlunos($codTurma){
        return $this->db->query("select * from aluno where codAluno in (select codAluno from aluno_turma where codTurma = $codTurma)");
    }

    public function getModulos($codTurma){
        return $this->db->query("select * from itens_contrataveis where codCurso = (select codCurso from turma where codTurma = $codTurma) and status = 1");
    }
    
    public function inserirCertificado($parametros){
        $aux = $this->db->get_where("aluno_certificado", array(
            "codAluno" => $parametros["codAluno"],
            "codModulo" => $parametros["codModulo"]
        ));
        
        if($aux->num_rows() == 0){
            $this->db->insert("aluno_certificado", $parametros);
        }
    }
    
    public function getCertificadosAImprimir($codTurma, $codModulo){
        
        return $this->db->select("*")
                ->from("aluno a")
                ->join("aluno_certificado ac","ac.codAluno = a.codAluno")
                ->join("aluno_turma at", "at.codAluno = a.codAluno")
                ->where("ac.codModulo", $codModulo)
                ->where("at.codTurma", $codTurma)
                ->get();
        
    }
    
    public function getSalasMesmoCurso($codTurma, $precisaTerVagas=0){
        
        $codCurso = $this->db->get_where("turma", array("codTurma" => $codTurma))->row(0)->codCurso;
        
        $this->db->select("t.*");
        $this->db->from("turma t");
        $this->db->where("codCurso", $codCurso);
        $this->db->where("codTurma<>", $codTurma);
        if($precisaTerVagas > 0){
            $this->db->where("numVagas>", 0);
        }
        $this->db->where("t.status", 1);
        return $this->db->get();
        
    }
    
    public function getModuloAtual($codTurma){
        return $this->db->query("select modulo from turma where codTurma = $codTurma");
    }
    
    public function gerarMedia($codTurma){
        
        
        
    }
}
