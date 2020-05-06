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
    <link rel="stylesheet" href="css/unsemantic-grid-responsive.css">
    <link href="https://fonts.googleapis.com/css?family=Orbitron&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
	  <title>Quiz</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</head>
<body style=" margin: 0px; padding: 0px; background-color: #1C1C1C;">

<div class="grid-100" style="padding: 0PX;"> <!-- DIV PRINCIPAL GRID-100 -->

<div>
  <?php 
      include('menu2.php');
   ?>
</div>

<div class="grid-100 "><!--  DIV DOS QUIZ GRID-90 -->
<div class="grid-100"> <!-- CODIGO -->

  <?php
  if (!($pergunta == $consultaId[0]["pp"])) {
  ?>
  <form name="frmQuizId" method="POST" action="tentarQuiz.php">

<!--   <div class="grid-90" style="text-align: center;" > -->
<div class="grid-40">
     <!-- <p style="text-align: left;"><img width="80%" style="border: solid 4px white; " src="<?=$consultaQ[0]["foto"]?> "> </p> -->
</div>
<div class="grid-100" >
 <!--   <p><?=$dadosQuiz?></p>  -->
  <p class="perguntaQuiz"><?=$consultaP[$pergunta]["texto"]?></p>

  <?php 

   ?>
  <fieldset class="radio-image">  

    <div class="grid-100">
    <div class="alternativa" >
    <label for="A">
    	<input id="A" type="radio" class="button" name="resposta" value="1" required="required"><?=$consultaR[0]["resposta"]?>
       <img src="icons/right.png"  width="20px" alt="Masculino">  
    </div>
  </label>


    <div class="alternativa"> 
      <label for="B">
    	<input id="B" type="radio" class="button" name="resposta" value="2"><?=$consultaR[1]["resposta"]?>
      <img src="icons/right.png"  width="20px" alt="Masculino">
    </div>
  </label>

   
    <div class="alternativa"> 
      <label for="C"> 
    	<input id="C" type="radio" class="button" name="resposta" value="3"><?=$consultaR[2]["resposta"]?>
          <img src="icons/right.png"  width="20px" alt="Masculino">
    </div>
  </label>


    <div class="alternativa"> 
      <label for="D"> 
    	<input id="D" type="radio" class="button"  name="resposta" value="4"><?=$consultaR[3]["resposta"]?>
      <img src="icons/right.png"  width="20px" alt="Masculino">
    </div>
  </label>
     </fieldset>


    <input type="submit" value="PRÓXIMA" class="submit"> 


  	<input type="hidden" name="id" value="<?=$id?>">
    <input type="hidden" name="pergunta" value="<?=$pergunta?>">
  </form>
  </div>


  <?php 
  }else{
  ?>
    <h3 style="font-size: 70px; background-color: red; color: white; margin: 5px;">Você acertou <?=$contador?> de <?=$pergunta?></h3>

<a href="home.php?categoria"><img src="icons/seta2.png" width="5%"></a>

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