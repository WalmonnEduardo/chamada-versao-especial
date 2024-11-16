<?php
require_once("Nome.php");
require_once("Texto.php");
require_once("IProfessor.php");
class Professor extends Nome implements IProfessor
{
    private string $disciplina;
    private int $siap;
    private string $gmail;
    public function __toString()
    {
        $itens = ["Nome","Disciplina","Siap","Email"];
        $m = Texto::contagem($itens);
        return Texto::alinhar_topicos("Nome",$m,": ").$this->nome."\n".Texto::alinhar_topicos("Disciplina",$m,": ").$this->disciplina."\n".Texto::alinhar_topicos("Siap",$m,": ").$this->siap."\n".Texto::alinhar_topicos("Email",$m,": ").$this->gmail."\n";
    }
    
    public function getHorarioAtendimento()
    {
        return "Envie uma mensagem para ".$this->gmail." e podemos marcar um horário\n";
    }

    /**
     * Get the value of disciplina
     */
    public function getDisciplina(): string
    {
        return $this->disciplina;
    }

    /**
     * Set the value of disciplina
     */
    public function setDisciplina(string $disciplina): self
    {
        $this->disciplina = $disciplina;

        return $this;
    }

    /**
     * Get the value of siap
     */
    public function getSiap(): int
    {
        return $this->siap;
    }

    /**
     * Set the value of siap
     */
    public function setSiap(int $siap): self
    {
        $this->siap = $siap;

        return $this;
    }

    /**
     * Get the value of gmail
     */
    public function getGmail(): string
    {
        return $this->gmail;
    }

    /**
     * Set the value of gmail
     */
    public function setGmail(string $gmail): self
    {
        $this->gmail = $gmail;

        return $this;
    }
}
?>
