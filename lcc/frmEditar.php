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
$login = $_SESSION['login'];

//quizes
$sqlQuiz = $PDO->prepare("SELECT q.id, p.nreal, p.email, q.titulo, q.foto, q.categoria FROM quiz q, register p WHERE q.id_usuario = p.id AND login == '$login'");
$sqlQuiz->execute();
$dadosQuiz = $sqlQuiz->fetchAll();



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
    <link rel="stylesheet" href="css/style1.css?time=<?=time()?>">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
  	<title>Perfil</title>
  </head>
  <body>
    <div class="grid-container-100">
    <div  class="grid-100">

<div style="text-align: center;">

  <a href="home.php"><img src="icons/seta2.png" width="3%"> </a>
  <p><form name="frmEditar" method="POST" action="editarConta.php"></p>
    
 <p style="padding-bottom: 20px;"><input type="email" name="email" maxlength="100" autofocus="autofocus" required="required" placeholder="E-mail" value="<?=$consulta[0]["email"]?>"></p> 

  <p style="padding-bottom: 20px"><input type="text" name="bio" maxlength="" autofocus="autofocus"  pattern="[a-zA-Z0-9- ]+" placeholder="Biografia" value="<?=$consulta[0]["bio"]?>"></p> 

  <a href="frmFoto.php?id=<?=$id?>" >
      <img   style="border-color: purple; border-style: groove; " width="20%" align="center" src="fotos/<?=$id?>.jpg" alt="Selecione sua foto" >
    </a> 

      <h3><?=@urldecode($_GET["fotoAtualiza"])?></h3>
  
<input type="hidden" name="id" value="<?=$id?>">

  <p style="padding-bottom: 20px"><input type="submit" value="OK"></p>

<div class="grid-100 people_title">
  <h3 style="font-style: italic; padding-top: 20px; padding-bottom: 20px">Criados por Você</h3>
    <?php  
      foreach ($dadosQuiz as $quizzes) {  
    ?>
        <a href="frmQuizId.php?id=<?=$quizzes["id"]?>">
        <div class="grid-20 mobile-grid-50 people" >    
        <p class="textoUpImagem" style="text-decoration: none; color: white">
          <?=$quizzes["titulo"]?>   
        </p>
        <p >
          <img class="imagemQuiz" width="100%" height="100%" src="<?=$quizzes["foto"]?>">
        </p>
        <p class="textoUpImagem2" ><?=$quizzes["categoria"]?></p>
        </p>
      </div>
    </a>
    <?php
      }
    ?>
    </div>


</div>
  </form>
  </body>
  </html>


  