<?php
require_once 'BaseDAO.php';
require_once 'entity/Disciplina.php';
require_once 'entity/Aluno.php';
require_once 'entity/Professor.php';
require_once 'config/Database.php';

class DisciplinaDAO
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM Disciplina WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Disciplina($row['id'], $row['nome'], $row['carga_horaria']);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM Disciplina";
        $stmt = $this->db->query($sql);
        $disciplinas = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $disciplinas[] = new Disciplina($row['id'], $row['nome'], $row['carga_horaria']);
        }
        return $disciplinas;
    }

    public function create($disciplina)
    {
        $sql = "INSERT INTO Disciplina (nome, chave, carga_horaria) VALUES (:nome, :chave, :carga_horaria)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nome', $disciplina->getNome());
        $stmt->bindParam(':chave', $disciplina->getChave());
        $stmt->bindParam(':carga_horaria', $disciplina->getCargaHoraria());
        $stmt->execute();
    }

    public function update($disciplina)
    {
        $sql = "UPDATE Disciplina SET nome = :nome, chave = :chave, carga_horaria = :carga_horaria WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nome', $disciplina->getNome());
        $stmt->bindParam(':chave', $disciplina->getChave());
        $stmt->bindParam(':carga_horaria', $disciplina->getCargaHoraria());
        $stmt->bindParam(':id', $disciplina->getId());
        $stmt->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM Disciplina WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    // Método para obter disciplina com seus alunos
    public function getDisciplinaWithAlunos($disciplinaID)
    {
        /*
        Implemnte o retorno de uma disciplina, contendo seus respectivos alunos
        */
        $sql = "SELECT d.*, a.matricula AS aluno_matricula, a.nome AS aluno_nome
                FROM disciplina d
                JOIN disciplina_aluno da ON d.id = da.disciplina_id
                JOIN aluno a ON da.aluno_id = a.matricula
                WHERE d.id = :disciplinaID";
     
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':disciplinaID', $disciplinaID);
        $stmt->execute();
     
        $disciplina = null;
        $alunos = [];
     
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (!$disciplina) {
                $disciplina = new Disciplina($row['id'], $row['nome'], $row['carga_horaria']);
            }
            if ($row['aluno_matricula']) {
                $aluno = new Aluno($row['aluno_matricula'], $row['aluno_nome']);
                $alunos[] = $aluno;
            }
        }
        if ($disciplina) {
            $disciplina->setAlunos($alunos);
            return $disciplina;
        }
    

        return null;
    }

    // Método para obter os professores da disciplina
    public function getProfessoresForDisciplina($disciplinaID)
    {
        $sql = "SELECT p.id, p.nome, p.disciplina_id FROM professor p
            WHERE p.disciplina_id = :disciplinaID";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':disciplinaID', $disciplinaID);
        $stmt->execute();

        $professores = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $professores[] = new Professor($row['id'], $row['nome'], $row['disciplina_id']);
        }

        return $professores;
    }
}
