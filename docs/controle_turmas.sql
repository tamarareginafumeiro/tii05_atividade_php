-- Criar o banco de dados e tabelas
CREATE DATABASE IF NOT EXISTS controle_turmas;
USE controle_turmas;

CREATE TABLE IF NOT EXISTS disciplina (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    carga_horaria INT NOT NULL
);

CREATE TABLE IF NOT EXISTS professor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    disciplina_id INT,
    FOREIGN KEY (disciplina_id) REFERENCES disciplina(id)
);

CREATE TABLE IF NOT EXISTS aluno (
    matricula INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS disciplina_aluno (
    aluno_id INT,
    disciplina_id INT,
    PRIMARY KEY (aluno_id, disciplina_id),
    FOREIGN KEY (aluno_id) REFERENCES aluno(matricula),
    FOREIGN KEY (disciplina_id) REFERENCES disciplina(id)
);

-- Inserir dados nas tabelas

-- Disciplinas relacionadas à informática
INSERT INTO disciplina (nome, carga_horaria) VALUES ('Programação Orientada a Objetos', 80);
INSERT INTO disciplina (nome, carga_horaria) VALUES ('Banco de Dados', 60);
INSERT INTO disciplina (nome, carga_horaria) VALUES ('Redes de Computadores', 50);
INSERT INTO disciplina (nome, carga_horaria) VALUES ('Estrutura de Dados', 75);
INSERT INTO disciplina (nome, carga_horaria) VALUES ('Sistemas Operacionais', 55);

-- Professores e disciplinas que eles lecionam
INSERT INTO professor (nome, disciplina_id) VALUES ('Carlos Silva', 1);  -- Leciona Programação Orientada a Objetos
INSERT INTO professor (nome, disciplina_id) VALUES ('Ana Pereira', 2);   -- Leciona Banco de Dados
INSERT INTO professor (nome, disciplina_id) VALUES ('Paulo Souza', 3);   -- Leciona Redes de Computadores
INSERT INTO professor (nome, disciplina_id) VALUES ('Maria Lima', 4);    -- Leciona Estrutura de Dados
INSERT INTO professor (nome, disciplina_id) VALUES ('Rafael Oliveira', 5); -- Leciona Sistemas Operacionais

-- Alunos
INSERT INTO aluno (nome) VALUES ('João Santos');
INSERT INTO aluno (nome) VALUES ('Mariana Costa');
INSERT INTO aluno (nome) VALUES ('Lucas Alves');
INSERT INTO aluno (nome) VALUES ('Fernanda Ribeiro');
INSERT INTO aluno (nome) VALUES ('Pedro Fernandes');

-- Associar alunos às disciplinas (disciplina_aluno)
-- João Santos está matriculado em Programação Orientada a Objetos e Banco de Dados
INSERT INTO disciplina_aluno (aluno_id, disciplina_id) VALUES (1, 1); -- João Santos em Programação Orientada a Objetos
INSERT INTO disciplina_aluno (aluno_id, disciplina_id) VALUES (1, 2); -- João Santos em Banco de Dados

-- Mariana Costa está matriculada em Banco de Dados e Estrutura de Dados
INSERT INTO disciplina_aluno (aluno_id, disciplina_id) VALUES (2, 2); -- Mariana Costa em Banco de Dados
INSERT INTO disciplina_aluno (aluno_id, disciplina_id) VALUES (2, 4); -- Mariana Costa em Estrutura de Dados

-- Lucas Alves está matriculado em Redes de Computadores e Sistemas Operacionais
INSERT INTO disciplina_aluno (aluno_id, disciplina_id) VALUES (3, 3); -- Lucas Alves em Redes de Computadores
INSERT INTO disciplina_aluno (aluno_id, disciplina_id) VALUES (3, 5); -- Lucas Alves em Sistemas Operacionais

-- Fernanda Ribeiro está matriculada em Programação Orientada a Objetos e Estrutura de Dados
INSERT INTO disciplina_aluno (aluno_id, disciplina_id) VALUES (4, 1); -- Fernanda Ribeiro em Programação Orientada a Objetos
INSERT INTO disciplina_aluno (aluno_id, disciplina_id) VALUES (4, 4); -- Fernanda Ribeiro em Estrutura de Dados

-- Pedro Fernandes está matriculado em Programação Orientada a Objetos e Redes de Computadores
INSERT INTO disciplina_aluno (aluno_id, disciplina_id) VALUES (5, 1); -- Pedro Fernandes em Programação Orientada a Objetos
INSERT INTO disciplina_aluno (aluno_id, disciplina_id) VALUES (5, 3); -- Pedro Fernandes em Redes de Computadores
