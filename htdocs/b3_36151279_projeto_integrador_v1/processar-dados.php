<?php
require_once 'config.php';

//PEGANDO OS DADOS VINDOS DO FORMULÁRIO
$nome = $_POST['nome'];
$email = $_POST['email'];
$data_coleta = $_POST['data_coleta'];
$periodo = $_POST['periodo'];
$local = $_POST['local'];
$telefone = $_POST['telefone'];
$data_atual = date('d/m/Y'); 
 

//PREPARAR COMANDO PARA TABELA
$smtp = $conn->prepare("INSERT INTO agendamentos(nome, email, data_coleta, periodo, local, telefone, data_atual) VALUES (?,?,?,?,?,?,?)");
$smtp->bind_param("sssssss",$nome, $email, $data_coleta, $periodo, $local, $telefone, $data_atual);


//SE EXECUTAR CORRETAMENTE
if($smtp->execute()){
    $result = $conn->query("SELECT max(id) FROM agendamentos");
    $row = $result->fetch_row();
    $maxId = $row[0]; // Obtém o valor máximo do ID
    echo "Agendamento realizado com sucesso! Seu protocolo é: " . $maxId;
    
}else{
    echo "Erro no envio da mensagem: ".$smtp->error;
}

$smtp->close();
$protoc->close();
$conn->close();



?>
