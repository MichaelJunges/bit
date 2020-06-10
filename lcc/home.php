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

 $login = $_SESSION['login'];
 $id = $_SESSION['id'];
 $nreal = $_SESSION['nreal'];
 $email = $_SESSION['email'];
 $bio = $_SESSION['bio'];
 $_SESSION["contador"] = 0;
 $_SESSION["pergunta"] = 0;

// MOSTRA quizes recentes
 $sqlQuiz = $PDO->prepare("SELECT q.id, p.nreal, p.email, q.titulo, q.foto, q.categoria FROM quiz q, register p WHERE q.id_usuario = p.id AND login != '$login'");
 $sqlQuiz->execute();
 $dadosQuiz = $sqlQuiz->fetchAll();

// $PDO categorias lateral
 @$categoria = $_GET['categoria'];
 $sqlQuiz = $PDO->prepare("SELECT DISTINCT categoria FROM quiz where categoria!='' ORDER BY categoria ASC");
 $sqlQuiz->execute();
 $dadosCategoria = $sqlQuiz->fetchAll();

// $PDO pega por categorias
 $sqlCarrega = $PDO->prepare("SELECT * FROM quiz where categoria=='$categoria'");
 $sqlCarrega->execute();
 $carregaCategoria = $sqlCarrega->fetchAll();


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>QUIZ/<?=$nreal?></title>
 	<link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Barlow&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/unsemantic-grid-responsive.css">
	<link rel="stylesheet" href="css/style1.css?time=<?=time()?>">
	<link rel="stylesheet" href="css/login.css?time=<?=time()?>">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script> 

</head>
<body>
	<div class="grid-container-100"> 
	<div class="grid-100" style="padding: 0;"> <!-- DIV PRINCIPAL GRID-100 -->
		<?php 
			include('menu2.php');
		?>
	</div>

	<div class="grid-100 " style="padding: 0; display: block;"><!--  DIV DOS QUIZ GRID-90 -->
		<h1  style="padding: 0px; margin: 0px; background-color: white;"><?=$categoria?></h1>
	</div>
	<?php  
	    foreach ($carregaCategoria as $recaregados) {  
	?>
	    <a  class="grid-25 mobile-grid-50" style="margin-top: 20px; text-decoration: none;" href="frmQuizId.php?id=<?=$recaregados["id"]?>">
	        <div class="people" > 
		        <div class="zoom ">
		         	<img class="imagemQuiz" width="100%" height="100%" src="<?=$recaregados["foto"]?>">
		         	 <div class="txtimg">
				  <p><?=$recaregados["titulo"]?></p>
				  </div>
		      	</div> 
	      	</div> 
	    </a>

	<?php
	    }
		if (empty(@$categoria)) { 
		  foreach ($dadosQuiz as $quizzes) {	
		?>
		  <a class="grid-25 mobile-grid-50" style="text-decoration: none; margin: 0" href="frmQuizId.php?id=<?=$quizzes["id"]?>">
		  	<div class="people"> 
				<div class="zoom">
				  <img class="imagemQuiz img-responsive" width="100%" height="100%" src="<?=$quizzes["foto"]?>">
				  <div class="txtimg">
				  <p><?=$quizzes["titulo"]?></p>
				  </div>
				</div>
			</div>
		  </a>
		<?php
		  }
		?>
	</div>
	<?php 
		}
	?>
	</div>
</body>
</html>