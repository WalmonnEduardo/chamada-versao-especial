<?php
require_once("Nome.php");
class Aluno extends Nome implements JsonSerializable
{
    private int $numMatricula;
    private array $presenca;
    public static function criarAlunos(array $recolherdados)
    {
        for($i = 0 ; $i < count($recolherdados) ; $i++)
        {
            $alunos[$i] = new Aluno();
            $alunos[$i]->setNome($recolherdados[$i]['nome']);
            $alunos[$i]->setNumMatricula($recolherdados[$i]['numMatricula']);
            $alunos[$i]->setPresenca($recolherdados[$i]['presenca']);
        }
        return $alunos;
    }
    public function jsonSerialize(): mixed
    {
        return $aluno = [
            "nome" => $this->getNome(),
            "numMatricula" => $this->getNumMatricula(),
            "presenca" => $this->getPresenca()
        ];
    }
    public function __construct()
    {
        $this->presenca = array();
    }
    /**
     * Get the value of numMatricula
     */
    public function getNumMatricula(): int
    {
        return $this->numMatricula;
    }

    /**
     * Set the value of numMatricula
     */
    public function setNumMatricula(int $numMatricula): self
    {
        $this->numMatricula = $numMatricula;

        return $this;
    }

    /**
     * Get the value of presenca
     */
    public function getPresenca(): array
    {
        return $this->presenca;
    }

    /**
     * Set the value of presenca
     */
    public function setPresenca(array $presenca): self
    {
        $this->presenca = $presenca;

        return $this;
    }
}
