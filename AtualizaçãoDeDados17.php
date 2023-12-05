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

// Criação da tabela fornecedores se não existir
$sqlCreateTable = "CREATE TABLE IF NOT EXISTS fornecedores (
    id_fornecedor INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    contato VARCHAR(255) NOT NULL
)";

if ($conn->query($sqlCreateTable) === FALSE) {
    echo "Erro na criação da tabela fornecedores: " . $conn->error;
}

// Criação da tabela compras se não existir
$sqlCreateTableCompras = "CREATE TABLE IF NOT EXISTS compras (
    id_compra INT AUTO_INCREMENT PRIMARY KEY,
    id_fornecedor INT,
    produto_comprado VARCHAR(255) NOT NULL,
    quantidade INT,
    FOREIGN KEY (id_fornecedor) REFERENCES fornecedores(id_fornecedor)
)";

if ($conn->query($sqlCreateTableCompras) === FALSE) {
    echo "Erro na criação da tabela compras: " . $conn->error;
}

// Atualização de informações dos fornecedores
$sqlUpdateFornecedor1 = "UPDATE fornecedores SET nome='Empresa A Atualizada', contato='novo_contato@empresaA.com' WHERE id_fornecedor=1";
$sqlUpdateFornecedor2 = "UPDATE fornecedores SET nome='Empresa B Atualizada', contato='novo_contato@empresaB.com' WHERE id_fornecedor=2";

// Modificação de detalhes das compras associadas aos fornecedores
$sqlUpdateCompra1 = "UPDATE compras SET produto_comprado='Novas Peças de computador', quantidade=200 WHERE id_fornecedor=1";
$sqlUpdateCompra2 = "UPDATE compras SET produto_comprado='Novo Material de escritório', quantidade=1000 WHERE id_fornecedor=2";

// Executa as consultas
if ($conn->query($sqlUpdateFornecedor1) === TRUE &&
    $conn->query($sqlUpdateFornecedor2) === TRUE &&
    $conn->query($sqlUpdateCompra1) === TRUE &&
    $conn->query($sqlUpdateCompra2) === TRUE) {
    echo "Informações atualizadas com sucesso.";
} else {
    echo "Erro na atualização: " . $conn->error;
}

// Fecha a conexão
$conn->close();

?>
