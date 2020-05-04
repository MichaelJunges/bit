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
 $buscar = $_POST["buscar"];
 $login = $_SESSION['login'];
 $id = $_SESSION['id'];
 $nreal = $_SESSION['nreal'];
 $email = $_SESSION['email'];
 $bio = $_SESSION['bio'];
 $_SESSION["contador"] = 0;
 $_SESSION["pergunta"] = 0;

// MOSTRA quizes recentes
 $sqlQuiz = $PDO->prepare("SELECT * FROM quiz WHERE titulo LIKE ? OR categoria LIKE ?");
 $sqlQuiz->execute(array("%$buscar%","%$buscar%"));
 $dadosQuiz = $sqlQuiz->fetchAll();

// $PDO categorias lateral
 @$categoria = $_GET['categoria'];
 $sqlQuiz = $PDO->prepare("SELECT DISTINCT categoria FROM quiz where categoria!='' ORDER BY categoria ASC");
 $sqlQuiz->execute();
 $dadosCategoria = $sqlQuiz->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>QUIZ/<?=$nreal?></title>
 	<link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Barlow&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/unsemantic-grid-responsive.css">
	<link rel="stylesheet" href="css/style1.css?time=<?=time()?>">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script> 

</head>
<body style=" margin: 0px; padding: 0px; background-color: rgb(51,109,226)">
	  
<!-- <iframe hidden="hidden" src="https://www.youtube.com/embed/5Mj8AlkKISw?autoplay=1;mute=1'"> </iframe> -->
	
<div class="grid-100" style="padding: 0PX;"> <!-- DIV PRINCIPAL GRID-100 -->
	<?php 
		 include('menu.php');
	 ?>
<div class="grid-90 " style="padding: 0px; display: block;"><!--  DIV DOS QUIZ GRID-90 -->
<div class="grid-100" style="padding: 0px;" > <!-- DIV QUE CARREGA QUIZ RECENTES (categoria=) -->
	<h1  style="padding: 0px; margin: 0px; background-color: white; border-radius: 20px;">RESULTADOS: <?=$buscar?> </h1>
		<?php  
		  foreach ($dadosQuiz as $quizzes) {	
		?>

		  <a style="text-decoration: none;" href="frmQuizId.php?id=<?=$quizzes["id"]?>">
		  	<div class="grid-20 mobile-grid-100 people"  > 
				<p class="textoUpImagem" >
				  <?=$quizzes["titulo"]?>		
				</p>
				<p >
				  <img class="imagemQuiz" width="100%" height="100%" src="<?=$quizzes["foto"]?>">
				</p>
				<p class="textoDownImagem"><?=$quizzes["categoria"]?></p>
		  </a>
		  </div>
		<?php
		  }
		?>
 </div>
</div>
</body>
</html>