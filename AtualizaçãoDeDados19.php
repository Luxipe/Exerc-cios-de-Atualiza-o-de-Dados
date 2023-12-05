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

// Criação da tabela eventos
$sqlCreateEventos = "CREATE TABLE IF NOT EXISTS eventos (
    id_evento INT PRIMARY KEY,
    nome_evento VARCHAR(255),
    data DATE
)";

if ($conn->query($sqlCreateEventos) === TRUE) {
    echo "Tabela eventos criada ou já existente.<br>";
} else {
    echo "Erro ao criar tabela eventos: " . $conn->error;
}

// Criação da tabela participantes
$sqlCreateParticipantes = "CREATE TABLE IF NOT EXISTS participantes (
    id_participante INT PRIMARY KEY,
    id_evento INT,
    nome_participante VARCHAR(255),
    FOREIGN KEY (id_evento) REFERENCES eventos(id_evento)
)";

if ($conn->query($sqlCreateParticipantes) === TRUE) {
    echo "Tabela participantes criada ou já existente.<br>";
} else {
    echo "Erro ao criar tabela participantes: " . $conn->error;
}

// Inserção de dados na tabela eventos
$sqlEventos = "INSERT INTO eventos (id_evento, nome_evento, data) VALUES
    (1, 'Conferência de Tecnologia', '2023-12-15'),
    (2, 'Workshop de Marketing Digital', '2023-11-20')";

if ($conn->query($sqlEventos) === TRUE) {
    echo "Dados inseridos na tabela eventos com sucesso.<br>";
} else {
    echo "Erro ao inserir dados na tabela eventos: " . $conn->error;
}

// Inserção de dados na tabela participantes
$sqlParticipantes = "INSERT INTO participantes (id_participante, id_evento, nome_participante) VALUES
    (1, 1, 'Gabriel'),
    (2, 2, 'Sofia')";

if ($conn->query($sqlParticipantes) === TRUE) {
    echo "Dados inseridos na tabela participantes com sucesso.<br>";
} else {
    echo "Erro ao inserir dados na tabela participantes: " . $conn->error;
}

// Atualização de detalhes de eventos e participantes
$sqlUpdateEventos = "UPDATE eventos SET nome_evento = 'Nova Conferência', data = '2024-01-10' WHERE id_evento = 1";
$sqlUpdateParticipantes = "UPDATE participantes SET nome_participante = 'Novo Participante' WHERE id_participante = 1";

if ($conn->query($sqlUpdateEventos) === TRUE && $conn->query($sqlUpdateParticipantes) === TRUE) {
    echo "Dados atualizados com sucesso.<br>";
} else {
    echo "Erro ao atualizar dados: " . $conn->error;
}

$conn->close();
?>
