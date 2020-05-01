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

$sqlQuiz = $PDO->prepare("SELECT * FROM quiz where categoria == 'FUTEBOL'");
$sqlQuiz->execute();
$dadosCategoria = $sqlQuiz->fetchAll();

  ?>

  <!DOCTYPE html>
  <html>
  <head>
  	<title>Categorias</title>
  	<link rel="stylesheet" href="../css/unsemantic-grid-responsive.css">
	<link rel="stylesheet" href="../css/login.css?time=<?=time()?>">
  <link rel="stylesheet" href="../css/style1.css?time=<?=time()?>">
  </head>
  <body >

    <div class="grid-100 people_title" style="padding: 0px">
    <?php  
      foreach ($dadosCategoria as $quizzes) {  
    ?>
      <a href="frmQuizId.php?id=<?=$quizzes["id"]?>">
        <div class="grid-20 mobile-grid-100 people" > 
        <p class="textoUpImagem" style="text-decoration: none; color: white">
          <?=$quizzes["titulo"]?>   
        </p>
        <p >
          <img class="imagemQuiz" width="100%" height="100%" src="<?=$quizzes["foto"]?>">
        </p>
        <p class="textoUpImagem2"><?=$quizzes["categoria"]?></p>
        </p>
      </div>
      </a>
    <?php
      }
    ?>
  </body>
  </html>