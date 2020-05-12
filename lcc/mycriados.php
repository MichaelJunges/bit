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
$dadosQuiz2 = $sqlQuiz->fetchAll();


//Consulta
  $sqlSelect = $PDO->prepare("SELECT * FROM register WHERE id=?");
  $sqlSelect->execute(array($id));
  $consulta = $sqlSelect->fetchAll(); 

 @$categoria = $_GET['categoria'];
 $sqlQuiz = $PDO->prepare("SELECT DISTINCT categoria FROM quiz where categoria!='' ORDER BY categoria ASC");
 $sqlQuiz->execute();
 $dadosCategoria = $sqlQuiz->fetchAll();




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

<div>
  <?php 
      include('menu2.php');
    ?>

</div>

<div class="grid-100 people_title" style="padding: 0px;">
  <h3 style="font-style: italic; padding-top: 20px; padding-bottom: 20px">Criados por Você</h3>
  <?php
   $result = count($dadosQuiz2);  
     ?>
    <p>Você tem um total de  <?=$result?> criado(s)</p>

    <?php  
      foreach ($dadosQuiz2 as $quizzes) {  
    ?>
        <a class="grid-25 mobile-grid-50" href="frmQuizId.php?id=<?=$quizzes["id"]?>">
        <div class="people" >    
          <div class="txtimg">
          <p><?=$quizzes["titulo"]?></p>
          </div>
        <p >
          <img class="imagemQuiz" width="100%" height="100%" src="<?=$quizzes["foto"]?>">
        </p>
        <p class="textoDownImagem"><?=$quizzes["categoria"]?></p>
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


  