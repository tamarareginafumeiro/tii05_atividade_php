<?php
require_once './dao/DisciplinaDAO.php';

$disciplinaDAO = new DisciplinaDAO();
$disciplinaID = $_GET['id'] ?? null;

if ($disciplinaID) {
    $disciplina = $disciplinaDAO->getDisciplinaWithAlunos($disciplinaID);
    $professores = $disciplinaDAO->getProfessoresForDisciplina($disciplinaID);
} else {
    echo "Disciplina não encontrada!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Disciplina</title>
</head>
<body>
    <h1>Detalhes da Disciplina</h1>

    <p><strong>ID:</strong> <?= $disciplina->getId(); ?></p>
    <p><strong>Nome:</strong> <?= $disciplina->getNome(); ?></p>
    <p><strong>Carga Horária:</strong> <?= $disciplina->getCargaHoraria(); ?> horas</p>

    <h2>Alunos Matriculados</h2>
    <ul>
        <?php foreach ($disciplina->getAlunos() as $aluno): ?>
            <li><?= $aluno->getNome(); ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Professores que Lecionam Esta Disciplina</h2>
    <ul>
        <?php foreach ($professores as $professor): ?>
            <li><?= $professor->getNome(); ?></li>
        <?php endforeach; ?>
    </ul>

    <a href="index.php">Voltar</a>
</body>
</html>
