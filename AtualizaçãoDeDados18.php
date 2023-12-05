<?php
// Nome: Gustavo De Oliveira Vital.PHP
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "processocadastro";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Criação da tabela livros
$sqlCreateLivros = "CREATE TABLE IF NOT EXISTS livros (
    id_livro INT PRIMARY KEY,
    titulo VARCHAR(255),
    ano_publicacao INT
)";

if ($conn->query($sqlCreateLivros) === TRUE) {
    echo "Tabela livros criada ou já existente.<br>";
} else {
    echo "Erro ao criar tabela livros: " . $conn->error;
}

// Criação da tabela autores
$sqlCreateAutores = "CREATE TABLE IF NOT EXISTS autores (
    id_autor INT PRIMARY KEY,
    nome_autor VARCHAR(255)
)";

if ($conn->query($sqlCreateAutores) === TRUE) {
    echo "Tabela autores criada ou já existente.<br>";
} else {
    echo "Erro ao criar tabela autores: " . $conn->error;
}

// Inserção de dados na tabela livros
$sqlLivros = "INSERT INTO livros (id_livro, titulo, ano_publicacao) VALUES
    (1, 'Aprendendo Python', 2020),
    (2, 'Introdução à Inteligência Artificial', 2019)";

if ($conn->query($sqlLivros) === TRUE) {
    echo "Dados inseridos na tabela livros com sucesso.<br>";
} else {
    echo "Erro ao inserir dados na tabela livros: " . $conn->error;
}

// Inserção de dados na tabela autores
$sqlAutores = "INSERT INTO autores (id_autor, nome_autor) VALUES
    (1, 'Carlos Silva'),
    (2, 'Ana Souza')";

if ($conn->query($sqlAutores) === TRUE) {
    echo "Dados inseridos na tabela autores com sucesso.<br>";
} else {
    echo "Erro ao inserir dados na tabela autores: " . $conn->error;
}

$conn->close();
?>
