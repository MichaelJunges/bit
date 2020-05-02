<?php
session_start();

if ($_SESSION["acesso"] != true)
{
  // Não está autenticado
  $mensagem = urlencode("Você precisa fazer login!");
  header("Location:index.php?msg=$mensagem");
  exit;
}
//Conexão com o banco de dados
$PDO = new PDO("sqlite:users.db");

$categoria = $_GET['categoria'];

$sqlQuiz = $PDO->prepare("SELECT * FROM quiz where categoria='$categoria'");
$sqlQuiz->execute();
$dadosCategoria = $sqlQuiz->fetchAll();
  ?>

  <!DOCTYPE html>
  <html>
  <head>
  	<title>Categorias</title>
  	<link rel="stylesheet" href="css/unsemantic-grid-responsive.css">
	<link rel="stylesheet" href="css/login.css?time=<?=time()?>">
  <link rel="stylesheet" href="css/style1.css?time=<?=time()?>">
  </head>
  <body >

    <div class="grid-100 people_title" style="padding: 0px">
    <?php  
      foreach ($dadosCategoria as $quizzes) {  
    ?>
<h1  style="padding: 0px"> <a href="home.php"><img src="icons/seta2.png" width="3%"> </a><?=$quizzes["categoria"]?></h1>
      <a href="frmQuizId.php?id=<?=$quizzes["id"]?>">
        <div class="grid-20 mobile-grid-100 people" > 
        <p class="textoUpImagem" style="text-decoration: none; color: white">
          <?=$quizzes["titulo"]?>   
        </p>
        <p >
          <img class="imagemQuiz" width="100%" height="100%" src="<?=$quizzes["foto"]?>">
        </p>
        <p class="textoDownImagem"><?=$quizzes["categoria"]?></p>
        </p>
      </div>
      </a>
    <?php
      }
    ?>
  </body>
  </html>