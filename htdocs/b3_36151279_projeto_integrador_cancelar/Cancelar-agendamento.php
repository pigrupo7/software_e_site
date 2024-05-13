<?php
require_once 'config.php';

//PEGANDO OS DADOS VINDOS DO FORMULÁRIO
$id = $_POST['id'];

//CONSULTAR BANCO
$sql = "SELECT * FROM agendamentos WHERE id='".$id."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $nome = $row["nome"];
  $email = $row["email"];
  $data_coleta = $row["data_coleta"];
  $periodo = $row["periodo"];
  $local = $row["local"];
  $telefone = $row["telefone"];
  
  // EXIBIR INFORMACOES DO AGENDAMENTO
  echo "<p>-----------------------------</p>";
  echo "<p>O Agendamento:</p>";
  echo "<p>Nome: $nome</p>";
  echo "<p>Email: $email</p>";
  echo "<p>Data de Coleta: $data_coleta</p>";
  echo "<p>Periodo: $periodo</p>";
  echo "<p>Local: $local</p>";
  echo "<p>Telefone: $telefone</p>";
  
  // DELETAR O AGENDAMENTO
  $sql_delete = "DELETE FROM agendamentos WHERE id='".$id."'";
  if ($conn->query($sql_delete) === TRUE) {
    echo "<p>Foi cancelado com sucesso.</p>";
  } else {
    echo "Erro ao cancelar o agendamento: " . $conn->error;
  }
} else {
  echo "Protocolo informado não existe.";
}

$conn->close();


?>
