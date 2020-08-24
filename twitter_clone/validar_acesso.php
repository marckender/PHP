<?php 

require_once('db.php');

  
  $usuario = $_POST['usuario'];
  $senha = $_POST['senha'];

  $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha' ";

  $objDb = new db();
  $link =$objDb->connecta_mysql();

  $resultado_id= mysqli_query($link, $sql);

  if ($resultado_id) {
    $dados_usuarios = mysqli_fetch_array($resultado_id);
    var_dump($dados_usuarios);

  } else {
    echo 'Erro na execuçao da consulta';
  }


  //update
  //insert true | false
  // select false | resource
  //delete

?>