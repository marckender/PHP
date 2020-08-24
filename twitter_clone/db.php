<?php 

  class db {
    //host
    private $host ='localhost';

    //usuario
    private $usuario ='root';

    //senha
    private $senha ='';

    //banco de dados 
    private $database = 'twitter_clone';


    public function  connecta_mysql() {

      //criar connection
      $connection= mysqli_connect( $this->host, $this->usuario, $this->senha, $this->database);

      //ajustart charset entre aplicaçao e o banco de dados
      mysqli_set_charset($connection, 'utf8');


      //verificar se houve erro de conexao
      if (mysqli_connect_error() ){
        echo 'Erro ao tentar conectar com o BD mysql: '.mysqli_connect_error();
      }

      return $connection;

    }
  }

?>