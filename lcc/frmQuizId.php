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
  $pergunta = $_GET["pergunta"];
  @$contador = $_GET["contador"];
  if (empty($contador)) {
    $contador = 0;
  }

    //Consulta e pega quiz
	$sqlSelectQ = $PDO->prepare("SELECT * FROM quiz WHERE id=?");
	$sqlSelectQ->execute(array($id));
	$consultaQ = $sqlSelectQ->fetchAll();

  $sqlSelectP = $PDO->prepare("SELECT id, texto, certa FROM pergunta WHERE id_quiz = ?");
  $sqlSelectP->execute(array($consultaQ[0]["id"]));
  $consultaP = $sqlSelectP->fetchAll();

  $sqlId = $PDO->prepare("SELECT count(id) AS pp FROM pergunta WHERE id_quiz = ?");
  $sqlId->execute(array($consultaQ[0]["id"]));
  $consultaId = $sqlId->fetchAll();

  $sqlSelectR = $PDO->prepare("SELECT * FROM resposta WHERE id_pergunta = ?");
  @$sqlSelectR->execute(array($consultaP[$pergunta]["id"]));
  $consultaR = $sqlSelectR->fetchAll();
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
   <p><img width="30%" style="border: solid 1px black; margin-bottom: 10px " src="<?=$consultaQ[0]["foto"]?> "> </p>
</div>
<?php
if (!($pergunta == $consultaId[0]["pp"])) {
?>
<h1 style="font-family: 'Calibri';font-size: 40px; " class="titulo"><?=$consultaP[$pergunta]["texto"]?></h1>

<form name="frmQuizId" method="POST" action="tentarQuiz.php">
  <div class="alternativa">
  	<input type="radio" class="button" style="font-size: 2em" name="resposta" value="1" required="required"><?=$consultaR[0]["resposta"]?>
  </div><br>
  <div class="alternativa"> 
  	<input type="radio" class="button" style="font-size: 2em" name="resposta" value="2"><?=$consultaR[1]["resposta"]?>
  </div><br>
  <div class="alternativa"> 
  	<input type="radio" class="button" style="font-size: 2em" name="resposta" value="3"><?=$consultaR[2]["resposta"]?>
  </div><br>
  <div class="alternativa"> 
  	<input type="radio" class="button" style="font-size: 2em" name="resposta" value="4"><?=$consultaR[3]["resposta"]?>
  </div><br>
  <input type="submit" value="PRÓXIMA">
	<input type="hidden" name="id" value="<?=$id?>">
  <input type="hidden" name="contador" value="<?=$contador?>">
  <input type="hidden" name="pergunta" value="<?=$pergunta?>">
</form>
<?php }else{
  ?>
  <h2>Você acertou <?=$contador?> de <?=$pergunta?></h2>
  <?php
}?>
 	  <p>  
        <a style="color: black" href="home.php">
        ⬅️ Voltar Pagina !</a>
    </p>

</div>
</body>
</html>