<?php
session_start();

// <!-- Validando o acesso do Usuario -->
if ($_SESSION["acesso"] != true) {
	
	$mensagem = urldecode("Usuário e/ou Senha inválidos");
  	header("Location:index.php?msg=$mensagem"); // L maiúsculo obrigatório
  	exit; //importa (SAIR)
  }

//Conexão
$PDO = new PDO("sqlite:users.db");
$id = $_SESSION["id"];
?>  

  <!DOCTYPE html>
  <html>
  <head>
  	<link rel="stylesheet" href="css/unsemantic-grid-responsive.css">
  	<link rel="stylesheet" href="css/style1.css?time=<?=time()?>">
    <link href="https://fonts.googleapis.com/css?family=Orbitron&display=swap" rel="stylesheet">
  	<title>Alterar Foto</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  </head>
  <body>
    <div class="grid-container">
    <div style="padding-top: 7%" class="grid-100">

<div class="foco">
  	<h1 class="titulo">Foto</h1>
  <form name="frmFoto" method="POST" action="foto.php" enctype="multipart/form-data" >

 <p><input type="file" name="foto" autofocus="autofocus" required="required"></p> 


  <input type="hidden" name="id" value="<?=$id?>">

  <p><input type="submit" value="Enviar"></p>
  <p><input type="reset" value="Limpar"></p>
  <p>  
        <a style="color: black" href="home.php">
        ⬅️ Voltar Pagina !</a>
      </p>
</div>

  
</form>
  </body>
  </html>


  