<?php
// Nome: Gustavo De Oliveira Vital.PHP
$host = "localhost";
$usuario_bd = "root";
$senha_bd = "";
$nome_bd = "processocadastro";


$conexao = new mysqli($host, $usuario_bd, $senha_bd);


if ($conexao->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
}


$conexao->query("CREATE DATABASE IF NOT EXISTS $nome_bd");
$conexao->select_db($nome_bd);


if ($conexao->error) {
    die("Erro ao selecionar o banco de dados: " . $conexao->error);
}

// Definir o modo de caracteres para evitar problemas com acentos
$conexao->set_charset("utf8");

// Função para criar tabela 'departamentos'
function criarTabelaDepartamentos($conexao) {
    $query = "CREATE TABLE IF NOT EXISTS departamentos (
        id_departamento INT AUTO_INCREMENT PRIMARY KEY,
        nome_departamento VARCHAR(255) NOT NULL
    )";
    $conexao->query($query);
    if ($conexao->error) {
        die("Erro ao criar tabela 'departamentos': " . $conexao->error);
    }
}

// Função para criar tabela 'funcionarios'
function criarTabelaFuncionarios($conexao) {
    $query = "CREATE TABLE IF NOT EXISTS funcionarios (
        id_funcionario INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(255) NOT NULL,
        cargo VARCHAR(255) NOT NULL,
        id_departamento INT,
        FOREIGN KEY (id_departamento) REFERENCES departamentos(id_departamento)
    )";
    $conexao->query($query);
    if ($conexao->error) {
        die("Erro ao criar tabela 'funcionarios': " . $conexao->error);
    }
}

// Criar tabela 'departamentos'
criarTabelaDepartamentos($conexao);

// Inserir dados na tabela 'departamentos'
$nome_departamento_TI = "TI";
$query_departamento_TI = "INSERT INTO departamentos (nome_departamento) VALUES (?)";
$stmt_departamento_TI = $conexao->prepare($query_departamento_TI);
$stmt_departamento_TI->bind_param("s", $nome_departamento_TI);
$stmt_departamento_TI->execute();

$nome_departamento_RH = "Recursos Humanos";
$query_departamento_RH = "INSERT INTO departamentos (nome_departamento) VALUES (?)";
$stmt_departamento_RH = $conexao->prepare($query_departamento_RH);
$stmt_departamento_RH->bind_param("s", $nome_departamento_RH);
$stmt_departamento_RH->execute();

// Verificar erros nas consultas de inserção de departamentos
if ($stmt_departamento_TI->error || $stmt_departamento_RH->error) {
    die("Erro ao inserir departamentos: " . $stmt_departamento_TI->error . " / " . $stmt_departamento_RH->error);
}

// Criar tabela 'funcionarios'
criarTabelaFuncionarios($conexao);

// Informações dos funcionários
$funcionario_nome1 = "Luiz";
$funcionario_cargo1 = "Analista";
$id_departamento_funcionario1 = 1; // o ID do departamento associado ao Funcionario Luiz

$funcionario_nome2 = "Carla";
$funcionario_cargo2 = "Gerente";
$id_departamento_funcionario2 = 2; // o ID do departamento associado a funcionária Carla

// Inserir dados na tabela 'funcionarios'
$query_funcionario1 = "INSERT INTO funcionarios (nome, cargo, id_departamento) VALUES (?, ?, ?)";
$stmt_funcionario1 = $conexao->prepare($query_funcionario1);
$stmt_funcionario1->bind_param("ssi", $funcionario_nome1, $funcionario_cargo1, $id_departamento_funcionario1);
$stmt_funcionario1->execute();

$query_funcionario2 = "INSERT INTO funcionarios (nome, cargo, id_departamento) VALUES (?, ?, ?)";
$stmt_funcionario2 = $conexao->prepare($query_funcionario2);
$stmt_funcionario2->bind_param("ssi", $funcionario_nome2, $funcionario_cargo2, $id_departamento_funcionario2);
$stmt_funcionario2->execute();

// Verificar erros nas consultas de inserção de funcionários
if ($stmt_funcionario1->error || $stmt_funcionario2->error) {
    die("Erro ao inserir funcionários: " . $stmt_funcionario1->error . " / " . $stmt_funcionario2->error);
}

echo "Tabelas e dados inseridos com sucesso!<br>";

$conexao->close();
?>
