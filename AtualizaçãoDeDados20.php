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

// Criação da tabela resultados_exames
$sqlCreateResultadosExames = "CREATE TABLE IF NOT EXISTS resultados_exames (
    id_resultado INT PRIMARY KEY,
    tipo_exame VARCHAR(255),
    resultado VARCHAR(255)
)";

if ($conn->query($sqlCreateResultadosExames) === TRUE) {
    echo "Tabela resultados_exames criada ou já existente.<br>";
} else {
    echo "Erro ao criar tabela resultados_exames: " . $conn->error;
}

// Criação da tabela pacientes
$sqlCreatePacientes = "CREATE TABLE IF NOT EXISTS pacientes (
    id_paciente INT PRIMARY KEY,
    nome_paciente VARCHAR(255),
    data_nascimento DATE
)";

if ($conn->query($sqlCreatePacientes) === TRUE) {
    echo "Tabela pacientes criada ou já existente.<br>";
} else {
    echo "Erro ao criar tabela pacientes: " . $conn->error;
}

// Inserção de dados na tabela resultados_exames
$sqlResultadosExames = "INSERT INTO resultados_exames (id_resultado, tipo_exame, resultado) VALUES
    (1, 'Exame de Sangue', 'Normal'),
    (2, 'Raio-X', 'Fratura identificada')";

if ($conn->query($sqlResultadosExames) === TRUE) {
    echo "Dados inseridos na tabela resultados_exames com sucesso.<br>";
} else {
    echo "Erro ao inserir dados na tabela resultados_exames: " . $conn->error;
}

// Inserção de dados na tabela pacientes
$sqlPacientes = "INSERT INTO pacientes (id_paciente, nome_paciente, data_nascimento) VALUES
    (1, 'Mariana', '1995-06-10'),
    (2, 'Rafael', '1987-09-25')";

if ($conn->query($sqlPacientes) === TRUE) {
    echo "Dados inseridos na tabela pacientes com sucesso.<br>";
} else {
    echo "Erro ao inserir dados na tabela pacientes: " . $conn->error;
}

// Atualização de informações de resultados de exames e pacientes
$sqlUpdateResultadosExames = "UPDATE resultados_exames SET tipo_exame = 'Novo Exame', resultado = 'Resultado Atualizado' WHERE id_resultado = 1";
$sqlUpdatePacientes = "UPDATE pacientes SET nome_paciente = 'Novo Nome', data_nascimento = '1990-01-01' WHERE id_paciente = 1";

if ($conn->query($sqlUpdateResultadosExames) === TRUE && $conn->query($sqlUpdatePacientes) === TRUE) {
    echo "Dados atualizados com sucesso.<br>";
} else {
    echo "Erro ao atualizar dados: " . $conn->error;
}

$conn->close();
?>
