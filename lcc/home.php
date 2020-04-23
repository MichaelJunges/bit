<?php 

session_start();

if ($_SESSION["acesso"] != true)
{
		// Não está autenticado
	$mensagem = urlencode("Você precisa fazer login!");
	header("Location:index.php?msg=$mensagem");
	exit;
}


$PDO = new PDO("sqlite:users.db");


$login = $_SESSION['login'];
$id = $_SESSION['id'];
$nreal = $_SESSION['nreal'];
$email = $_SESSION['email'];
$bio = $_SESSION['bio'];


//quizes
$sqlQuiz = $PDO->prepare("SELECT q.pergunta, q.id, p.nreal, p.email, q.titulo FROM quiz q, register p WHERE q.id_usuario = p.id AND login != '$login'");
$sqlQuiz->execute();
$dadosQuiz = $sqlQuiz->fetchAll();


//perfil
$sqlUser = $PDO->prepare("SELECT * FROM register WHERE id = ?");
$sqlUser->execute(array($id));
$dados = $sqlUser->fetchAll();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
 	<link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Barlow&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/unsemantic-grid-responsive.css">
	<link rel="stylesheet" href="css/style1.css?time=<?=time()?>">
	<title>QUIZ/<?=$nreal?></title>
	<script>
		function limpaUrl() {     //função
		    urlpg = $(location).attr('href');   //pega a url atual da página
		    urllimpa = urlpg.split("?")[0]      //tira tudo o que estiver depois de '?'
		    window.history.replaceState(null, null, urllimpa); //subtitui a url atual pela url limpa
		}
		setTimeout(limpaUrl, 0) 
	</script>
</head>
<body style=" margin: 0px; padding: 0px "; >
	

	<div class="grid-container">
		<div class="grid-100" style="padding: 0px;">



<div class="sair" >	
	<a href="logoff.php" style=" text-decoration: none;  color: white;">SAIR</a>
</div>
			<div class="grid-100 about_me">
<!-- <div class="grid-10" style="width: 50%">
				<p><a href="frmFoto.php"><img style="object-fit: cover;width:100%; height: 100px; border-radius:0px; color: white" src="fotos/<?=$id?>.jpg"width="100%" alt="Selecionar Imagem"></a></p>
				</div> -->

				<!-- Bem-Vindo <?=$nreal?>   -->
<div style="text-align: left;">	
			<!-- <?=$dados[0]["email"]?> Bio: 
				<?=$dados[0]["bio"]?> --> <!--  NÃO PRECISA MOSTRAR -->

</div>
			<a class="azulEbranco" href="frmEditar.php"> Editar perfil </a>
			<a class="azulEbranco" href="frmCreateQuiz.php"> Criar Quizz </a>
		</div>

&nbsp

		<div class="grid-100 people_title" style="padding: 0px">
			<?php  
			foreach ($dadosQuiz as $quizzes) {	
				?>
				<div class="grid-50 people" > 
					<p>👣 <?=$quizzes["nreal"]?></p>
					 <p>  💎<a href="frmQuizId.php?id=<?=$quizzes["id"]?>"><?=$quizzes["titulo"]?></a> </p>
						<!-- <p>📝 Bio:<?=$quizzes["bio"]?> </p>	  -->
				</div>
				<?php
			}
			?>
		</div>
	&nbsp
	<div class="grid-100">
		&nbsp
		<p style=" color: white"><?=@urldecode($_GET["msg"])?></p>
	</div>
	</div>
</div>
</body>

</html>