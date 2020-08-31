<?php 


require_once('db.php');


  $sql = "SELECT * FROM usuarios ";

  $objDb = new db();
  $link =$objDb->connecta_mysql();

  $resultado_id= mysqli_query($link, $sql);

  if ($resultado_id) {
    $dados_usuario = mysqli_fetch_array($resultado_id);

  } else {
    echo 'Erro na execuçao da consulta';
  }


  //update
  //insert true | false
  // select false | resource
  //delete

?>