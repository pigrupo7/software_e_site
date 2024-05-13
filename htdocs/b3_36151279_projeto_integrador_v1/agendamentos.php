<?php
require_once 'config.php';

$senhaSecreta = "123";

if($_SERVER["REQUEST_METHOD"]== "POST"){
    $senhadigitada = $_POST['senha'];

    //DIGITOU A SENHA CERTO
    if($senhadigitada === $senhaSecreta){
        $sql = "SELECT * FROM agendamentos";
        $result = $conn->query($sql);
    }else{
        echo "<h1>Senha Incorreta!</h1>";
    }

}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver agendamentos</title>
    <!-- <link rel="stylesheet" href="estilo.css"> -->

<style>

body {
    width: 100vw;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-flow: column;
}

form {
    background: #e6e6e6;
    display: flex;
    flex-flow: column wrap;
    padding: 40px;
    border-radius: 10px;
    border: 1px solid #ccc;
}

input {
    width: 90%;
    height: 30px;
    margin-top: 15px;
    margin-bottom: 15px;
    padding: 10px;
}

textarea {
    width: 10%;
    margin-top: 15px;
    margin-bottom: 15px;
    padding: 10px;
}

button {
    background: green;
    color: white;
    padding: 15px 10px;
    border: none;
    cursor: pointer;
}

button:hover {
    background: rgb(13, 166, 13);
}

.mensagens {
    display: flex;
    flex-flow: column;
    background: #e6e6e6;
    padding: 20px;
    margin-top: 20px;
    border-radius: 10px;
}

</style>



</head>

<body>
    <form method="post">
        <label for="senha">Senha:</label>
        <input type="password" name="senha" placeholder="Digite sua senha" required>        
        <button type="submit">Enviar</button>
    </form>


    <div class="box">
    
        <?php if(isset($result) && $result->num_rows >0) : ?>
            <h2 style="text-align:center">Agendamentos</h2>
            <ul>
                <?php while($row = $result->fetch_assoc()) :?>
                    <li>
                        <strong>Nome: </strong> <?php echo $row["nome"]; ?><br>
                        <strong>email: </strong> <?php echo $row["email"]; ?><br>
                        <strong>data</strong> <?php echo $row["data_coleta"]; ?><br>
                        <strong>perido </strong> <?php echo $row["periodo"]; ?><br>
                        <strong>local</strong> <?php echo $row["local"]; ?><br>
                        <strong>telefone </strong> <?php echo $row["telefone"]; ?><br>
                        <strong>data_atual</strong> <?php echo $row["data_atual"]; ?><br><br>
                </li> 
                <?php endwhile; ?>    
                </ul>
                <?php else : ?>
                <p>Digite a senha para acessar os agendamentos:</p>
                    <?php endif; ?>
    </div>


</body>

</html>