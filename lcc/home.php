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

//quizes
$sqlQuiz = $PDO->prepare("SELECT q.id, p.nreal, p.email, q.titulo, q.foto, q.categoria FROM quiz q, register p WHERE q.id_usuario = p.id AND login != '$login'");
$sqlQuiz->execute();
$dadosQuiz = $sqlQuiz->fetchAll();



//perfil
$sqlUser = $PDO->prepare("SELECT * FROM register WHERE id = ?");
$sqlUser->execute(array($id));
$dados = $sqlUser->fetchAll();

//Mensagens enviadas de outras telas
// @$mensagem=urldecode($_GET["msg"]);

//categorias
$sqlQuiz = $PDO->prepare("SELECT * FROM quiz");
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
	<script>
		function limpaUrl() {     //função
		    urlpg = $(location).attr('href');   //pega a url atual da página
		    urllimpa = urlpg.split("?")[0]      //tira tudo o que estiver depois de '?'
		    window.history.replaceState(null, null, urllimpa); //subtitui a url atual pela url limpa
		}
		setTimeout(limpaUrl, 0)
	</script>
</head>
<body style=" margin: 0px; padding: 0px; background-color: rgb(51,109,226)">
	<div class="grid-container-100" style="margin-left: 20px; margin-right: 20px">

<div class="grid-100">

<div class="grid-25 mobile-grid-100" style="padding: 5px;">
	    <a href="suporte.php" style="text-decoration: none;">
		  <p class="criarEditar">4QUIZ</p>
		</a>
	 </div>
		 <div class="grid-25 mobile-grid-100" style="padding: 5px;">
		<a href="frmEditar.php" style="text-decoration: none;">
		  <p class="criarEditar">Meu Perfil</p>
		</a>
	  </div>

	  <div class="grid-25 mobile-grid-100" style="padding: 5px;">
		<a href="frmCreateQuiz.php" style="text-decoration: none;">
		  <p class="criarEditar">Criar Quiz</p>
		</a>
	  </div>

	  <div class="grid-25 mobile-grid-100" style="padding: 5px;">
	    <a href="logoff.php" style="text-decoration: none;">
		  <p class="criarEditar">Sair</p>
		</a>
	 </div>
	  </div>
	  
<!-- <iframe hidden="hidden" src="https://www.youtube.com/embed/5Mj8AlkKISw?autoplay=1;mute=1'"> </iframe> -->

	  <div class="grid-100 about_me">
		<p class="minhasInfo" >Nome: <?=$dados[0]["nreal"]?></p>	
	  </div>
	  <!-- <a href="<?=$categoria?>">Futebol</a> -->



<div class="grid-100">
	<?php  
		  foreach ($dadosCategoria as $quizzes) {	
		?>
<div class="grid-10 mobile-grid-100" style="padding: 5px;">
	    <a href="categoriaQuiz.php?categoria=<?=$quizzes["categoria"]?>" style="text-decoration: none;">
		  <p class="criarEditar"><?=$quizzes["categoria"]?></p>
		</a>
	 </div>
	 <?php
		  }
		?>
	</div>

	  <div class="grid-100 people_title" style="padding: 0px">
		<?php  
		  foreach ($dadosQuiz as $quizzes) {	
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
	  </div>
	</div>
</body>
</html>