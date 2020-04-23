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
		<div class="grid-100" style="padding: 0px">

			<div class="grid-100 about_me">
<div class="grid-10">
				<p><a href="frmFoto.php"><img style="object-fit: cover;width:100%; height: 200px; border-radius: 10px; color: white" src="fotos/<?=$id?>.jpg"width="50%" alt="Selecionar Imagem"></a></p>
				</div>

				Bem-Vindo <?=$nreal?>
			<div style="text-align: left;">

				<p><?=$dados[0]["email"]?></p>
				<p>Bio: <?=$dados[0]["bio"]?></p>	
				<p>&nbsp</p>
			</div>
			<a class="azulEbranco" href="frmEditar.php"> Editar perfil ⚙</a> 
			<p><a class="azulEbranco" href="frmCreateQuiz.php"> Criar Quizz 🤖</a> 	</p>
			<p style=" color: white"><?=@urldecode($_GET["msg"])?></p>	
			<p><a href="logoff.php" style="background-color:  #363636; border-radius: 30px; text-decoration: none; padding: 4px; color: white; ;" >SAIR ❌</a> </p>
			<p></p>
		</div>
		<div class="grid-80 people_title" style="padding: 0px">
			<?php  
			foreach ($dadosQuiz as $quizzes) {	
				?>
				<div class="grid-40 people " style="margin: 5px">
					<div class="grid-100" style="padding: 0px;">

						<p>👣 <?=$quizzes["nreal"]?></p>
					 <p>  💎<a style="color: white" href="frmQuizId.php?id=<?=$quizzes["id"]?>"><?=$quizzes["titulo"]?></a> </p>
						<!-- <p>📝 Bio:<?=$quizzes["bio"]?> </p>	  -->
					</div>	
				</div>
				<?php
			}
			?>
		</div>
	<p></p>
	</div>
</div>
</body>
</html>