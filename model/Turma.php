<?php
require_once("Nome.php");
class Aluno extends Nome
{
    private int $numMatricula;
    private array $presenca;

    
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
