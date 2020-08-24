<?php 

require_once('db.php');



$usuario = $_POST['usuario'];

$email = $_POST['email'];

$senha = $_POST['senha'];


$objDb = new db();
$link =$objDb->connecta_mysql();

$sql = " insert into usuarios(usuario, email, senha) values ('$usuario', '$email', '$senha')";

//executar a query (conexao, sql)
if (mysqli_query($link, $sql)) {
  echo 'inserido com sucesso';
} else {
  echo 'erro ao tentar registrar o usuario';
}


?>