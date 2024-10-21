<?php
require_once './dao/AlunoDAO.php';
require_once './dao/DisciplinaDAO.php';
require_once './dao/ProfessorDAO.php';

$alunoDAO = new AlunoDAO();
$disciplinaDAO = new DisciplinaDAO();
$professorDAO = new ProfessorDAO();

// Obter dados de alunos, disciplinas e professores
$alunos = $alunoDAO->getAll();
$disciplinas = $disciplinaDAO->getAll();
$professores = $professorDAO->getAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index - Sistema Acadêmico</title>
</head>
<body>
    <h1>Tabelas de Professores, Alunos e Disciplinas</h1>

    <h2>Professores</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Disciplina ID</th>
        </tr>
        <?php foreach ($professores as $professor): ?>
            <tr>
                <td><?= $professor->getId(); ?></td>
                <td><?= $professor->getNome(); ?></td>
                <td><?= $professor->getDisciplinaId(); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Alunos</h2>
    <table border="1">
        <tr>
            <th>Matrícula</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($alunos as $aluno): ?>
            <tr>
                <td><?= $aluno->getMatricula(); ?></td>
                <td><?= $aluno->getNome(); ?></td>
                <td><a href="detalhes_aluno.php?matricula=<?= $aluno->getMatricula(); ?>">Detalhes</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Disciplinas</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Carga Horária</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($disciplinas as $disciplina): ?>
            <tr>
                <td><?= $disciplina->getId(); ?></td>
                <td><?= $disciplina->getNome(); ?></td>
                <td><?= $disciplina->getCargaHoraria(); ?></td>
                <td><a href="detalhes_disciplina.php?id=<?= $disciplina->getId(); ?>">Detalhes</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
