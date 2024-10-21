<?php
class Professor {
    private $id;
    private $nome;
    private $disciplinaID;

    public function __construct($id, $nome, $disciplinaID) {
        $this->id = $id;
        $this->nome = $nome;
        $this->disciplinaID = $disciplinaID;
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getDisciplinaID() {
        return $this->disciplinaID;
    }

    public function setDisciplinaID($disciplinaID) {
        $this->disciplinaID = $disciplinaID;
    }
}
?>
