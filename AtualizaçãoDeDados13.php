<?php
// Nome: Gustavo De Oliveira Vital.PHP
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "processocadastro";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexao: " . $conn->connect_error);
}

// Criar a tabela clientes
$sql_create_clientes_table = "
    CREATE TABLE IF NOT EXISTS clientes (
        id_cliente INT PRIMARY KEY,
        nome VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL
    )
";

if ($conn->query($sql_create_clientes_table) === TRUE) {
    echo "Tabela 'clientes' criada ou já existente<br>";
} else {
    echo "Erro ao criar a tabela 'clientes': " . $conn->error . "<br>";
}

// Criar a tabela vendas
$sql_create_vendas_table = "
    CREATE TABLE IF NOT EXISTS vendas (
        id_venda INT PRIMARY KEY,
        id_cliente INT,
        produto_vendido VARCHAR(255) NOT NULL,
        valor DECIMAL(10,2) NOT NULL,
        FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente)
    )
";

if ($conn->query($sql_create_vendas_table) === TRUE) {
    echo "Tabela 'vendas' criada ou já existente<br>";
} else {
    echo "Erro ao criar a tabela 'vendas': " . $conn->error . "<br>";
}

// vai Inserir dados na tabela clientes
$sql_inserir_cliente_1 = "INSERT INTO clientes (id_cliente, nome, email) VALUES (1, 'Ana', 'ana@example.com')";
$sql_inserir_cliente_2 = "INSERT INTO clientes (id_cliente, nome, email) VALUES (2, 'Pedro', 'pedro@example.com')";

if ($conn->query($sql_inserir_cliente_1) === TRUE && $conn->query($sql_inserir_cliente_2) === TRUE) {
    echo "Dados dos clientes inseridos com sucesso<br>";
} else {
    echo "Erro ao inserir dados dos clientes: " . $conn->error . "<br>";
}

// vai Inserir dados na tabela vendas
$sql_inserir_venda_1 = "INSERT INTO vendas (id_venda, id_cliente, produto_vendido, valor) VALUES (1, 1, 'Celular', 1200.00)";
$sql_inserir_venda_2 = "INSERT INTO vendas (id_venda, id_cliente, produto_vendido, valor) VALUES (2, 2, 'Fones', 150.00)";

if ($conn->query($sql_inserir_venda_1) === TRUE && $conn->query($sql_inserir_venda_2) === TRUE) {
    echo "Dados das vendas inseridos com sucesso<br>";
} else {
    echo "Erro ao inserir dados das vendas: " . $conn->error . "<br>";
}

$conn->close();
?>
