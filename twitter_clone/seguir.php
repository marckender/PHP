<?php

session_start();

if (! isset($_SESSION['usuario'])) {
  header('Location: index.php?erro=1');
}



require_once('db.php');

$id_usuario = $_SESSION['id_usuario'];
$seguir_id_usuario = $_POST['seguir_id_usuario'];


if ($id_usuario =='' || $seguir_id_usuario =='') {
  die();
}
$objDb = new db();
$link =$objDb->connecta_mysql();

  $sql = "INSERT INTO usuarios_seguidores(id_usuario, seguindo_id_usuario) values($id_usuario, $seguir_id_usuario) ";

  echo $sql;

  mysqli_query($link, $sql);

?>