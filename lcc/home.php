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
$sqlQuiz = $PDO->prepare("SELECT q.pergunta, q.id, p.nreal, p.email FROM quiz q, register p WHERE q.id_usuario = p.id AND login != '$login'");
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
	<link href="https://fonts.googleapis.com/css?family=Orbitron&display=swap" rel="stylesheet">
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
		<div class="grid-100">

			<div class="grid-25 about_me">Logado(a): <?=$login?>
			<p></p>
			<div style="text-align: left;">

				<p><a href="frmFoto.php"><img style="object-fit: cover;width:100%; height: 200px; border-radius: 10px; color: white" src="fotos/<?=$id?>.jpg"width="100%" alt="Selecionar Imagem"></a></p>
				<p>✉ Contato: <?=$dados[0]["email"]?></p>
				<p>📝 Bio: <?=$dados[0]["bio"]?></p>	
				<p>&nbsp</p>
			</div>
			<a href="frmEditar.php"  style="background-color: white; border-radius: 30px; text-decoration: none; padding: 5px; ">Editar perfil ⚙</a> 
			<p><a href="logoff.php" style="background-color:  #363636; border-radius: 30px; text-decoration: none; padding: 4px; color: white; ;" >SAIR ❌</a> </p>
			<p></p>
			<p><a href="frmCreateQuiz.php"  style="background-color: white; border-radius: 30px; text-decoration: none; padding: 5px; ">Criar Quizz 🤖</a> 	</p>
			<p style=" color: white"><?=@urldecode($_GET["msg"])?></p>	
		</div>
		<div class="grid-75 people_title">
			<?php  
			foreach ($dadosQuiz as $quizzes) {	
				?>
				<div class="grid-100 people">
					<div class="grid-60" style="padding: 0px;">

						<p>👣 Criador: <?=$quizzes["nreal"]?>  📞 <a href="mailto:<?=$quizzes["email"]?>" style="color: white;"><?=$quizzes["email"]?></a> </p>
					 <p>  💎 4Quiz:<a style="color: white" href="frmQuizId.php?id=<?=$quizzes["id"]?>"><?=$quizzes["pergunta"]?></a> </p>
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