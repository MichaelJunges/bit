<?php
	session_start(); // Ligar Session

	// <!-- Validando o acesso do Usuario -->
	if ($_SESSION["acesso"] != true) {
	
	$mensagem = urldecode("Sem permissão");
  	header("Location:index.php?msg=$mensagem"); 
  	exit; //importa (SAIR)
 	 }
	
  // $esconderUrl = urldecode("teste");
  // header("Location:index.php?msg=$esconderUrl"); 

	//Conexão
	$PDO = new PDO("sqlite:users.db");
	$id = $_GET["id"];
	$pergunta = $_SESSION["pergunta"];
	$contador = $_SESSION["contador"];

    //Consulta e pega quiz
	$sqlSelectQ = $PDO->prepare("SELECT * FROM quiz WHERE id=?");
	$sqlSelectQ->execute(array($id));
	$consultaQ = $sqlSelectQ->fetchAll();

  $sqlSelectP = $PDO->prepare("SELECT id, texto, certa FROM pergunta WHERE id_quiz = ?");
  @$sqlSelectP->execute(array($consultaQ[0]["id"]));
  $consultaP = $sqlSelectP->fetchAll();

  $sqlId = $PDO->prepare("SELECT count(id) AS pp FROM pergunta WHERE id_quiz = ?");
 @$sqlId->execute(array($consultaQ[0]["id"]));
  $consultaId = $sqlId->fetchAll();

  $sqlSelectR = $PDO->prepare("SELECT * FROM resposta WHERE id_pergunta = ?");
  @$sqlSelectR->execute(array($consultaP[$pergunta]["id"]));
  $consultaR = $sqlSelectR->fetchAll();

  @$categoria = $_GET['categoria'];
 $sqlQuiz = $PDO->prepare("SELECT DISTINCT categoria FROM quiz where categoria!='' ORDER BY categoria ASC ");
 $sqlQuiz->execute();
 $dadosCategoria = $sqlQuiz->fetchAll();

$sqlQuizA = $PDO->prepare("SELECT r.nreal FROM quiz q, register r WHERE  q.id == '$id' AND q.id_usuario == r.id");
 $sqlQuizA->execute();
 $dadosQuiz = $sqlQuizA->fetchAll();
 // var_dump($dadosQuiz)
  ?>  


<!DOCTYPE html>
<html>
<head>
	  <!-- <link rel="stylesheet" href="css/unsemantic-grid-responsive.css"> -->
    <link rel="stylesheet" href="css/radioBox.css?time=<?=time()?>">
    <link rel="stylesheet" href="css/style1.css?time=<?=time()?>">
    <link rel="stylesheet" href="css/login.css?time=<?=time()?>">
    <link rel="stylesheet" href="css/unsemantic-grid-responsive.css">
    <link href="https://fonts.googleapis.com/css?family=Orbitron&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
	  <title>Quiz</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js">
    </script>
</head>
<body style=" margin: 0px; padding: 0px; background-color: #1C1C1C;">

<div class="grid-100" style="padding: 0PX;"> <!-- DIV PRINCIPAL GRID-100 -->

<div>
  <?php 

      include('menu2.php');
   ?>
</div>

<div class="grid-100" style="padding: 0px;"> <!-- CODIGO -->

  <?php
  if (!($pergunta == $consultaId[0]["pp"])) {
  ?>

<!--   <div class="grid-90" style="text-align: center;" > -->
<div class="grid-40">
     <!-- <p style="text-align: left;"><img width="80%" style="border: solid 4px white; " src="<?=$consultaQ[0]["foto"]?> "> </p> -->
</div>
<div class="grid-100" >
 <!--   <p><?=$dadosQuiz?></p>  -->
  <p class="perguntaQuiz"><?=$consultaP[$pergunta]["texto"]?></p>
  <fieldset class="radio-image">  

    <div class="grid-100" style="background-color: #DC143C">
      <a href="tentarQuiz.php?id=<?=$id?>&resposta=1" style="color:black;">
    <div class="alternativa">
    	<?=$consultaR[0]["resposta"]?>
    </div>
     </a>
<a href="tentarQuiz.php?id=<?=$id?>&resposta=2" style="color:black">
    <div class="alternativa"> 
    	<?=$consultaR[1]["resposta"]?>
    </div>
    </a>

   <a href="tentarQuiz.php?id=<?=$id?>&resposta=3" style="color:black;">
    <div class="alternativa" style="background-color: <?$color?>"> 
    	<?=$consultaR[2]["resposta"]?>
    </div>
  </a>


    <a href="tentarQuiz.php?id=<?=$id?>&resposta=4" style="color:black;">
      <div class="alternativa"> 
    	<?=$consultaR[3]["resposta"]?>
    </div>
  </a>
<!-- <div style="background-color: <?=$color?>">
 teste  
</div> -->
     </fieldset>
  </div>
  <?php 
  }else{
  ?>
    <h3 style="font-size: 70px; background-color: red; color: white; margin: 5px; margin-bottom: 100px;">PONTUAÇÃO <?=$contador?> de <?=$pergunta?></h3>

  <?php
      if ($contador == "0" && $pergunta == "0") {       
   ?>    
   <div style="text-align: center;">
   <h3>NÃO É ASSIM CARA....</h3>
    <img src="./icons/reprovado.gif" alt="meu gif">
    </div>
   <?php  

      }elseif ($contador == "0") {
        ?>
      <div style="text-align: center;">
   <h3>PUTSSSS...NENHUMA ?</h3>
    <img src="./icons/reprovado.gif" alt="meu gif">
    </div>
     <?php 

      }elseif ($contador == $pergunta - '1') {
        ?>
      <div style="text-align: center;">
   <h3>ESSA FOI POR POUCO...</h3>
    <img src="./icons/quase.gif" alt="meu gif">
    </div>
     <?php 

      }elseif ($pergunta == "0") {
        ?>
      <div style="text-align: center;">
   <h3>ESSA FOI POR POUCO...</h3>
    <img src="./icons/quase.gif" alt="meu gif">
    </div>
     <?php 
   }elseif ($contador == $pergunta  && $pergunta > "0") {       
   ?>    
   <div style="text-align: center;">
   <h3>PARABÉNS</h3>
    <img src="./icons/congru.gif" alt="meu gif">
    </div>
   <?php 
      }
  }?>

   </div>
 </div>
</div>
</body>
</html>