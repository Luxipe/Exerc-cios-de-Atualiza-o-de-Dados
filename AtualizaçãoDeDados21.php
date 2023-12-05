<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "processocadastro";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Criação do banco de dados
$sqlCreateDatabase = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sqlCreateDatabase) === TRUE) {
    echo "Banco de dados $dbname criado ou já existente.<br>";
} else {
    echo "Erro ao criar o banco de dados: " . $conn->error;
}

$conn->close();

// Conexão ao banco de dados processocadastro
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Criação da tabela usuarios
$sqlCreateUsuarios = "CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
)";

if ($conn->query($sqlCreateUsuarios) === TRUE) {
    echo "Tabela usuarios criada ou já existente.<br>";
} else {
    echo "Erro ao criar tabela usuarios: " . $conn->error;
}

// Criação da tabela compras
$sqlCreateCompras = "CREATE TABLE IF NOT EXISTS compras (
    id_compra INT PRIMARY KEY,
    id_usuario INT,
    produto_comprado VARCHAR(255) NOT NULL,
    quantidade INT,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
)";

if ($conn->query($sqlCreateCompras) === TRUE) {
    echo "Tabela compras criada ou já existente.<br>";
} else {
    echo "Erro ao criar tabela compras: " . $conn->error;
}

// Inserção de dados na tabela usuarios
$sqlInsertUsuarios = "INSERT INTO usuarios (id_usuario, nome, email) VALUES
    (3, 'Eduardo', 'eduardo@example.com'),
    (4, 'Laura', 'laura@example.com')";

if ($conn->query($sqlInsertUsuarios) === TRUE) {
    echo "Dados inseridos na tabela usuarios com sucesso.<br>";
} else {
    echo "Erro ao inserir dados na tabela usuarios: " . $conn->error;
}

// Inserção de dados na tabela compras
$sqlInsertCompras = "INSERT INTO compras (id_compra, id_usuario, produto_comprado, quantidade) VALUES
    (3, 3, 'Livro de Ficção', 3),
    (4, 4, 'Fones de Ouvido', 1)";

if ($conn->query($sqlInsertCompras) === TRUE) {
    echo "Dados inseridos na tabela compras com sucesso.<br>";
} else {
    echo "Erro ao inserir dados na tabela compras: " . $conn->error;
}

// Atualização de informações de usuarios e compras
$sqlUpdateUsuarios = "UPDATE usuarios SET nome = 'Novo Nome', email = 'novoemail@example.com' WHERE id_usuario = 3";
$sqlUpdateCompras = "UPDATE compras SET produto_comprado = 'Novo Produto', quantidade = 5 WHERE id_compra = 3";

if ($conn->query($sqlUpdateUsuarios) === TRUE && $conn->query($sqlUpdateCompras) === TRUE) {
    echo "Dados atualizados com sucesso.<br>";
} else {
    echo "Erro ao atualizar dados: " . $conn->error;
}

$conn->close();
?>
