<?php
require_once("Nome.php");
require_once("Texto.php");
require_once("IProfessor.php");
class Professor extends Nome implements IProfessor,JsonSerializable
{
    private string $disciplina;
    private int $siape;
    private string $gmail;
    public static function criarProfessor(array $recolherdados)
    {
        $professor = new Professor();
        $professor->setNome($recolherdados['nome']);
        $professor->setDisciplina($recolherdados['disciplina']);
        $professor->setSiape($recolherdados['siape']);
        $professor->setGmail($recolherdados['gmail']);
        return $professor;
    }
    public function jsonSerialize(): mixed
    {
        return $professor = [
            "nome" => $this->getNome(),
            "siape" => $this->getSiape(),
            "disciplina" => $this->getDisciplina(),
            "gmail" => $this->getGmail()
        ];
    }
    public function __toString()
    {
        $itens = ["Nome","Disciplina","Siap","Email"];
        $m = Texto::contagem($itens);
        return Texto::alinhar_topicos("Nome",$m,": ").$this->nome."\n".Texto::alinhar_topicos("Disciplina",$m,": ").$this->disciplina."\n".Texto::alinhar_topicos("Siape",$m,": ").$this->siape."\n".Texto::alinhar_topicos("Email",$m,": ").$this->gmail."\n";
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
    public function getSiape(): int
    {
        return $this->siape;
    }

    /**
     * Set the value of siap
     */
    public function setSiape(int $siape): self
    {
        $this->siape = $siape;

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
