<?php
require_once 'config.php';

//PEGANDO OS DADOS VINDOS DO FORMULÁRIO
$id = $_POST['id'];
$email = $_POST['email'];

// CONSULTAR BANCO
$sql_id = "SELECT * FROM agendamentos WHERE id='".$id."'";
$sql_email = "SELECT * FROM agendamentos WHERE email='".$email."'";

//VERIFICAR SE FOI INFORADO ID OU EMAIL
if ($id != ""){
    $result = $conn->query($sql_id);
}
else{
    $result = $conn->query($sql_email);
}

if ($result->num_rows > 0) {
    echo "<p>Agendamentos Encontrados:</p>";
  while($row = $result->fetch_assoc()) {
    $prot = $row["id"];  
    $nome = $row["nome"];
    $email = $row["email"];
    $data_coleta = $row["data_coleta"];
    $periodo = $row["periodo"];
    $local = $row["local"];
    $telefone = $row["telefone"];
  
  // EXIBE INFORMACOES DO AGENDAMENTO
    echo "<p>-----------------------------</p>";
    echo "<p>Protocolo: $prot</p>";
    echo "<p>Nome: $nome</p>";
    echo "<p>Email: $email</p>";
    echo "<p>Data de Coleta: $data_coleta</p>";
    echo "<p>Periodo: $periodo</p>";
    echo "<p>Local: $local</p>";
    echo "<p>Telefone: $telefone</p>";
    
    
  }

}
//if ($smtp->num_rows > 0) {
//    echo "protocolo - nome - email - data_coleta - periodo - local - telefone";
//    while($row = $smtp->fetch_assoc()) {
//        echo "<p>". $row["id"] . " - " . $row["nome"] . " - " . $row["email"] . " - " . $row["data_coleta"] . " - " . $row["periodo"] . " - " . $row["local"] . " - " . $row["telefone"] . "</p>";
//    }
//}

else{
    echo "Protocolo ou email informado não existem".$smtp->error;
}

$smtp->close();
$conn->close();


?>
