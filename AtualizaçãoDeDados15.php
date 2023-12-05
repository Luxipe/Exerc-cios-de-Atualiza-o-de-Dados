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

// Inserção de dados na tabela 'projetos'
$sql_insert_projetos = "INSERT INTO projetos (id_projeto, nome_projeto, descricao) VALUES
                        (1, 'Sistema de Controle', 'Desenvolvimento de um sistema interno'),
                        (2, 'Portal Corporativo', 'Desenvolvimento de um portal para clientes')";

if ($conn->query($sql_insert_projetos) === TRUE) {
    echo "Dados inseridos na tabela 'projetos' com sucesso.\n";
} else {
    echo "Erro ao inserir dados na tabela 'projetos': " . $conn->error . "\n";
}

// Inserção de dados na tabela 'atribuicoes'
$sql_insert_atribuicoes = "INSERT INTO atribuicoes (id_atribuicao, id_projeto, id_funcionario) VALUES
                            (1, 1, 1),
                            (2, 2, 2)";

if ($conn->query($sql_insert_atribuicoes) === TRUE) {
    echo "Dados inseridos na tabela 'atribuicoes' com sucesso.\n";
} else {
    echo "Erro ao inserir dados na tabela 'atribuicoes': " . $conn->error . "\n";
}

$conn->close();
?>
