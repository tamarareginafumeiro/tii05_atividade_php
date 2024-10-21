# Buscar uma disciplina com seus alunos
SELECT * FROM disciplina
	JOIN disciplina_aluno ON disciplina.id = disciplina_aluno.disciplina_id
	JOIN aluno ON disciplina_aluno.aluno_id = aluno.matricula
	WHERE disciplina.id = 1;

# Buscar um aluno com suas disciplinas
SELECT * FROM aluno
	JOIN disciplina_aluno ON aluno.matricula = disciplina_aluno.aluno_id
	JOIN disciplina ON disciplina_aluno.disciplina_id = disciplina.id
	WHERE aluno.matricula = 1