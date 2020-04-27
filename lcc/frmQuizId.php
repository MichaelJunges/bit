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
  @$mensagem=urldecode($_GET["msg"]);
  @$color=urldecode($_GET["cor"]);
  ?>  

<!DOCTYPE html>
<html>
<head>
	  <link rel="stylesheet" href="css/unsemantic-grid-responsive.css">
  	<link rel="stylesheet" href="css/style1.css?time=<?=time()?>">
    <link href="https://fonts.googleapis.com/css?family=Orbitron&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
	  <title>Quiz</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
      function limpaUrl() {     //função
          urlpg = $(location).attr('href');   //pega a url atual da página
          urllimpa = urlpg.split("?")[0]      //tira tudo o que estiver depois de '?'
          window.history.replaceState(null, null, urllimpa); //subtitui a url atual pela url limpa
      }
      setTimeout(limpaUrl, 0)
    </script>
</head>
<body style="background-color:  rgb(51,109,226); ">

 <div class="grid-container">

<div class="grid-100" >
   <p ><img width="30%" style="border: solid 1px black; margin-bottom: 10px " src="<?=$consulta[0]["foto"]?> "> </p>
</div>

<h1 style="font-family: 'Calibri';font-size: 40px; " class="titulo"><?=$consulta[0]["pergunta"]?></h1>

  	<p><form name="frmQuizId" method="POST" action="tentarQuiz.php"></p>

<div class="alternativa"> 
  	<input type="radio" class="button" style="font-size: 2em" name="resposta" value="1" required="required"><?=$consulta[0]["resposta"]?>
  </div> 
    <br>
    <div class="alternativa"> 
  	<input type="radio" class="button" style="font-size: 2em" name="resposta" value="2"><?=$consulta[0]["resposta2"]?>
      </div> 
     <br>
     <div class="alternativa"> 
  	<input type="radio" class="button" style="font-size: 2em" name="resposta" value="3"><?=$consulta[0]["resposta3"]?>
      </div> 
     <br>
     <div class="alternativa"> 
  	<input type="radio" class="button" style="font-size: 2em" name="resposta" value="4"><?=$consulta[0]["resposta4"]?>
      </div> 
      <br>

    <input type="submit" value="Confirmar">
	<input type="hidden" name="id" value="<?=$id?>">
</form>
    <h2 style="color:<?=$color?>;"><?=$mensagem?></h2>
  	<!-- <p><input type="submit" value="Confirmar"></p> -->
 	 <p>  
        <a style="color: black" href="home.php">
        ⬅️ Voltar Pagina !</a>
      </p>

</div>
    </body>
</html>