<?php
require_once("Nome.php");
require_once("Professor.php");
require_once("Aluno.php");
require_once("Texto.php");
class Turma extends Nome
{
    private Professor $responsavel;
    private array $alunos;
    private array $diasChamada;

    public function __construct()
    {
        $this->diasChamada = array();
    }
    public function converter() :string
    {
        $nomes = array();
        $matricula = array();
        for($i = 0 ; $i < count($this->alunos) ;$i++)
        {
            $nomes[] = $this->alunos[$i]->getNome();
        }
        for($i = 0 ; $i < count($this->alunos) ;$i++)
        {
            $matricula[] = $this->alunos[$i]->getNumMatricula();
        }
        $tamanho = Texto::contagem($nomes);
        $a = "";
        for($i = 0 ; $i < count($nomes);$i++)
        {
            if($i == 0)
            {
                $a = Texto::alinhar_topicos($nomes[$i],$tamanho,": ").$matricula[$i]."\n";
            }
            else
            {
                $a .= Texto::alinhar_topicos($nomes[$i],$tamanho,": ").$matricula[$i]."\n";
            }
        }
        return $a;
    }
    public function __toString()
    {
        $alunos = $this->converter();
        return  "==================================================================================================================================================\n". 
                "Nome da turma: ".$this->nome."\n". 
                "--------------------------------------------------------------------------------------------------------------------------------------------------\n". 
                "Professor responsável: \n\n".
                $this->responsavel."\n".
                "--------------------------------------------------------------------------------------------------------------------------------------------------\n".
                "Aluno : Número de matrícula \n\n".
                $alunos.
                "==================================================================================================================================================\n"; 
                
    }
    /**
     * Get the value of responsavel
     */
    public function getResponsavel(): Professor
    {
        return $this->responsavel;
    }

    /**
     * Set the value of responsavel
     */
    public function setResponsavel(Professor $responsavel): self
    {
        $this->responsavel = $responsavel;

        return $this;
    }

    /**
     * Get the value of alunos
     */
    public function getAlunos(): array
    {
        return $this->alunos;
    }

    /**
     * Set the value of alunos
     */
    public function setAlunos(array $alunos): self
    {
        $this->alunos = $alunos;

        return $this;
    }

    /**
     * Get the value of diasChamada
     */
    public function getDiasChamada(): array
    {
        return $this->diasChamada;
    }

    /**
     * Set the value of diasChamada
     */
    public function setDiasChamada(array $diasChamada): self
    {
        $this->diasChamada = $diasChamada;

        return $this;
    }
}

?>
