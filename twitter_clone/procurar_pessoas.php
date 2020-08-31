<?php
  session_start();

  if (! isset($_SESSION['usuario'])) {
    header('Location: index.php?erro=1');
	}
	
	require_once('db.php');
	
	$objDb = new db();
	$link =$objDb->connecta_mysql();

	$id_usuario = $_SESSION['id_usuario'];
	
	//--qtde Tweets
	$sql = "SELECT COUNT(*) AS qtde_tweets FROM tweet WHERE id_usuario = $id_usuario ";

	$resultado_id = mysqli_query($link, $sql);

	$qtde_tweets = 0;

	if ($resultado_id){
		$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);

		$qtde_tweets=$registro['qtde_tweets'];

	} else {
		echo 'erro ao executar a query na pagina Home';
	}


	//--dtde de seguidores

		//--qtde Tweets
		$sql = "SELECT COUNT(*) AS qtde_seguidores FROM usuarios_seguidores WHERE seguindo_id_usuario = $id_usuario ";

		$resultado_id = mysqli_query($link, $sql);
	
		$qtde_seguidores = 0;
	
		if ($resultado_id){
			$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
	
			$qtde_seguidores=$registro['qtde_seguidores'];
	
		} else {
			echo 'erro ao executar a query na pagina Home';
		}
?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Twitter clone</title>
		
		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	
	<script type="text/javascript">
		$(document).ready(function(){

				//associar o evento click ao botao
				$('#btn_procurar_pessoa').click(function(){
					
					if($('#nome_pessoa').val().length > 0 ) {
							$.ajax({
								url: 'get_pessoas.php',
								method: 'post',
								data: $('#form_procurar_pessoas').serialize(),
								success: function(data) {
                  $('#pessoas').html(data);


									$('.btn_seguir').click(function(){
										let id_usuario = $(this).data('id_usuario');
										
										$('#btn_seguir_' + id_usuario).hide();
										$('#btn_deixar_seguir_' + id_usuario).show();


										$.ajax({
											url:'seguir.php',
											method:'post',
											data: { seguir_id_usuario: id_usuario },
											success: function(data) {
												alert('requisicao efetuada com sucesso');
											}
										});

									});

									$('.btn_deixar_seguir').click(function(){
										let id_usuario = $(this).data('id_usuario');

										$('#btn_seguir_'+ id_usuario).show();
										$('#btn_deixar_seguir_'+ id_usuario).hide();

										$.ajax({
											url:'deixar_seguir.php',
											method:'post',
											data: { deixar_seguir_id_usuario: id_usuario },
											success: function(data) {
												alert(' removido com sucesso');
											}
										});
									});

								}
							});
					}
				});


		});

	</script>
	</head>

	<body>

		<!-- Static navbar -->
	    <nav class="navbar navbar-default navbar-static-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <img src="imagens/icone_twitter.png" />
	        </div>
	        
	        <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
            <li><a href="home.php">Home</a></li>
	            <li><a href="sair.php">sair</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>


	    <div class="container">
	    	
	    	<br /><br />

	    	<div class="col-md-3">
					<div class="panel panel-default">
						<div class="panel-body">
							<h4><?= $_SESSION['usuario'] ?></h4>
							<hr/>

							<div class="col-md-6">
								Tweets <br/> <?= $qtde_tweets ?>
							</div>
							<div class="col-md-6">
								Seguidores <br/> <?= $qtde_seguidores ?>
							</div>
						</div>
					</div>
				</div>
	    	<div class="col-md-6">
        	<div class="panel panel-default">
				 		<div class="panel-body">
							<form id="form_procurar_pessoas" class="input-group">
								<input type="text" name="nome_pessoa" id="nome_pessoa" class="form-control" placeholder="quem vc esta procurando ?" maxlength="140"/>
								<span class="input-group-btn">
									<button type="button" id="btn_procurar_pessoa" class="btn btn-default">procurar</button>
								</span>
							</form>
					 	</div>
				 	</div>

					 <!-- Tweets -->

					 <div id="pessoas" class="list-group">
					 
					 </div>
			  </div>
				<div class="col-md-3">
					<div class="panel panel-default">
						<div class="panel-body">
 						</div>
					</div>
				</div>
			</div>


	    </div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>