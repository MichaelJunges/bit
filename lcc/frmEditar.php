<?php
session_start();

// <!-- Validando o acesso do Usuario -->
if ($_SESSION["acesso"] != true) {
	
	$mensagem = urldecode("ERRO");
  	header("Location:index.php?msg=$mensagem"); // L maiúsculo obrigatório
  	exit; //importa (SAIR)
  }

//Conexão
$PDO = new PDO("sqlite:users.db");
$id = $_SESSION["id"];


//Consulta
$sqlSelect = $PDO->prepare("SELECT * FROM register WHERE id=?");
	$sqlSelect->execute(array($id));
	$consulta = $sqlSelect->fetchAll(); 
  ?>  

  <!DOCTYPE html>
  <html>
  <head>
  	<link rel="stylesheet" href="css/unsemantic-grid-responsive.css">
  	<link rel="stylesheet" href="css/login.css?time=<?=time()?>">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
  	<title>Alterar Conta</title>
  </head>
  <body>
    <div class="grid-container">
    <div  class="grid-100">

<div style="text-align: center;">
  	<h1>  <a class="aviso" href="home.php">< </a>EDITAR </h1>

  	<p><form name="frmEditar" method="POST" action="editarConta.php"></p>

 <p><input type="email" name="email" maxlength="100" autofocus="autofocus" required="required" placeholder="E-mail" value=<?=$consulta[0]["email"]?>></p> 

  <p><input type="text" name="bio" maxlength="" autofocus="autofocus" required="required" pattern="[a-zA-Z0-9- ]+" placeholder="Biografia" value="<?=$consulta[0]["bio"]?>"></p> 

  <a href="frmFoto.php?id=<?=$id?>" >
      <img  style="border-color: purple; border-style: solid;" width="20%" align="center" src="fotos/<?=$id?>.jpg" alt="Selecione sua foto" >
    </a> 

      <h3><?=@urldecode($_GET["fotoAtualiza"])?></h3>
  
<input type="hidden" name="id" value="<?=$id?>">

  <p><input type="submit" value="OK"></p>
</div>

  
  </form>
  </body>
  </html>


  