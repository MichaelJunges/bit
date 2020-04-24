<?php
	session_start(); // Ligar Session

	// <!-- Validando o acesso do Usuario -->
	if ($_SESSION["acesso"] != true) {
	
	$mensagem = urldecode("ERRO 404");
  	header("Location:index.php?msg=$mensagem"); 
  	exit; //importa (SAIR)
 	 }
	
	//Conexão
	$PDO = new PDO("sqlite:users.db");
	$id = $_GET["id"];


    //Consulta e pega quiz
	$sqlSelect = $PDO->prepare("SELECT * FROM quiz WHERE id=?");
	$sqlSelect->execute(array($id));
	$consulta = $sqlSelect->fetchAll(); 

  ?>  

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/unsemantic-grid-responsive.css">
  	<link rel="stylesheet" href="css/style1.css?time=<?=time()?>">
    <link href="https://fonts.googleapis.com/css?family=Orbitron&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
	<title>Quiz da pessoa clikada</title>
</head>
<body style="background-color: white">

 <div class="grid-container">
    <div class="grid-100">





<h1 style="font-family: 'Press Start 2P', cursive;font-size: 20px; " class="titulo"><?=$consulta[0]["pergunta"]?></h1>

<div class="grid-100" >
   <p ><img width="50%" style="border: solid 1px black; margin-bottom: 10px " src="<?=$consulta[0]["foto"]?> "> </p>
</div>

  	<p><form name="frmQuizId" method="POST" action="tentarQuiz.php"></p>

  	<input type="button" style="font-size: 2em" name="correta" value="<?=$consulta[0]["correta"]?>">
  	<input type="button" style="font-size: 2em" name="errada" value="<?=$consulta[0]["errada"]?>">
  	<input type="button" style="font-size: 2em" name="errada2" value="<?=$consulta[0]["errada2"]?>">
  	<input type="button" style="font-size: 2em" name="errada3" value="<?=$consulta[0]["errada3"]?>">	

	<input type="hidden" name="id" value="<?=$id?>">

  	<!-- <p><input type="submit" value="Confirmar"></p> -->

	<h3><?=@$e?></h3>
 	 <p>  
        <a style="color: black" href="home.php">
        ⬅️ Voltar Pagina !</a>
      </p>

</div>
    </body>
</html>