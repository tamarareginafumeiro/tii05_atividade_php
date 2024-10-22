<?php
require_once 'BaseDAO.php';
require_once 'entity/Aluno.php';
require_once 'entity/Disciplina.php';
require_once 'config/Database.php';

class AlunoDAO
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM Aluno WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Aluno($row['matricula'], $row['nome']);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM Aluno";
        $stmt = $this->db->query($sql);
        $alunos = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $alunos[] = new Aluno($row['matricula'], $row['nome']);
        }
        return $alunos;
    }

    public function create($aluno)
    {
        $sql = "INSERT INTO Aluno (nome) VALUES (:nome)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nome', $aluno->getNome());
        $stmt->execute();
    }

    public function update($aluno)
    {
        $sql = "UPDATE Aluno SET nome = :nome WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nome', $aluno->getNome());
        $stmt->bindParam(':id', $aluno->getId());
        $stmt->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM Aluno WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    // Método para obter aluno com suas disciplinas
    public function getAlunoWithDisciplinas($alunoID)
      {
        $sql = "SELECT a.*, d.id AS disciplina_id, d.nome AS disciplina_nome, d.carga_horaria 
                FROM aluno a 
                JOIN disciplina_aluno da ON a.matricula = da.aluno_id 
                JOIN disciplina d ON da.disciplina_id = d.id 
                WHERE a.matricula = :matricula";
    
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':matricula', $alunoID);
        $stmt->execute();
    
        $aluno = null;
        $disciplinas = [];
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (!$aluno) {
                $aluno = new Aluno($row['matricula'], $row['nome']);
            }
    
            
            if ($row['disciplina_id']) {
                $disciplina = new Disciplina($row['disciplina_id'], $row['disciplina_nome'], $row['carga_horaria']);
                $disciplinas[] = $disciplina;
            }
        }
    
        if ($aluno) {
            $aluno->setDisciplinas($disciplinas); 
            return $aluno; 
        }
       
        return null;
    }
}
