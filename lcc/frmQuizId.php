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
 $sqlQuiz = $PDO->prepare("SELECT * FROM quiz where categoria!=''");
 $sqlQuiz->execute();
 $dadosCategoria = $sqlQuiz->fetchAll();

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

<div class="grid-100" style="padding-top: 15PX;"> <!-- DIV PRINCIPAL GRID-100 -->

<div class="grid-10 mobile-grid-100 gridCategorias " style="padding: 0px;" > <!-- DIV LATERAL GRID-10 -->

<div class="grid-100" style="padding: 0px;"> <!-- DIV CONTA (LATERAL) -->
  <p class="textoUpImagem">Conta</p>
  <a  class="minhasInfo" href="frmEditar.php" ><p class="minhasConta" style="padding: 5px;" >Perfil</p></a>
  <a class="minhasInfo" href="tipoQuiz.php"><p class="minhasConta" style="padding: 5px">Criar Quiz</p></a>
   <a href="logoff.php" style="text-decoration: none;">
      <p class="textoUpImagem" style="font-size: 15px; text-align: center; background-color:black">SAIR</p>
  </a>
 </div>

<div>  <!-- DIV CATEGORIAS (LATERAL) -->
 <p class="textoUpImagem">Categorias</p> 
    <a href="home.php?categoria" style="text-decoration: none;">
      <p class="categorias"> RECENTES <!-- <img src="icons/estrela.png" width="25px" height="25px" style="vertical-align: middle;"> --></p>
    </a>    
    <?php  
      foreach ($dadosCategoria as $quizzes) { 
    ?>
    <!-- <a href="home.php?categoria=<?=$categoria?>" style="text-decoration: none;"> -->
      <a href="home.php?categoria=<?=$quizzes["categoria"]?>" style="text-decoration: none;">
     <p class="categorias"><?=$quizzes["categoria"]?></p>
    </a>
   <?php
      }
    ?>
     </div> 

<div><!--  DIV SOBRE (LATERAL) -->

 <p class="textoUpImagem">Sobre</p>
  
  <a href="suporte.php" style="text-decoration: none;"><p class="categorias">Tutorial</p></a>
  <a href="suporte.php" style="text-decoration: none;"><p class="categorias">Desenvolvedores</p></a>
  </div>

</div>
<div class="grid-90 " style="padding: 0px; display: block;"><!--  DIV DOS QUIZ GRID-90 -->
<div> <!-- CODIGO -->

  <?php
  if (!($pergunta == $consultaId[0]["pp"])) {
  ?>
  <form name="frmQuizId" method="POST" action="tentarQuiz.php">

  <div class="grid-90" style="text-align: center;" >
<div class="grid-40">

     <p style="text-align: left;"><img width="80%" style="border: solid 4px white; " src="<?=$consultaQ[0]["foto"]?> "> </p>
</div>
<!--   <h3 style="font-family: 'Calibri';font-size: 40px; " class="titulo"><a href="home.php?categoria"><img src="icons/seta2.png" width="3%"> </a></h3> -->
<div class="grid-60">
  <p style="font-size: 40px; font-weight: 500px;color:white; "><?=$consultaP[$pergunta]["texto"]?></p>
  <fieldset class="radio-image ">  

    <div class="grid-100">
    <div class="alternativa" >
    <label for="A">
    	<input id="A" type="radio" class="button" name="resposta" value="1" required="required"><?=$consultaR[0]["resposta"]?>
       <img src="icons/right.png"  width="20px" alt="Masculino">  
    </div><br>
  </label>


    <div class="alternativa"> 
      <label for="B">
    	<input id="B" type="radio" class="button" name="resposta" value="2"><?=$consultaR[1]["resposta"]?>
      <img src="icons/right.png"  width="20px" alt="Masculino">
    </div><br>
  </label>

   
   
    <div class="alternativa"> 
      <label for="C"> 
    	<input id="C" type="radio" class="button" name="resposta" value="3"><?=$consultaR[2]["resposta"]?>
          <img src="icons/right.png"  width="20px" alt="Masculino">
    </div><br>
  </label>


    <div class="alternativa"> 
      <label for="D"> 
    	<input id="D" type="radio" class="button"  name="resposta" value="4"><?=$consultaR[3]["resposta"]?>
      <img src="icons/right.png"  width="20px" alt="Masculino">
    </div><br>
  </label>
     </fieldset>

    <input type="submit" value="PRÓXIMA"> 
  	<input type="hidden" name="id" value="<?=$id?>">
    <input type="hidden" name="pergunta" value="<?=$pergunta?>">
  </form>
  </div>


  <?php 
  }else{
  ?>
    <h3 style="font-size: 70px; background-color: red; color: white; margin: 5px;">Você acertou <?=$contador?> de <?=$pergunta?></h3>
  <a href="home.php?categoria"><img src="icons/seta2.png" width="5%"><a href=""></a>


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