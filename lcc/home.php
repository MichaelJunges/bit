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
$sqlQuiz = $PDO->prepare("SELECT q.pergunta, q.id, p.nreal, p.email, q.titulo, q.foto FROM quiz q, register p WHERE q.id_usuario = p.id AND login != '$login'");
$sqlQuiz->execute();
$dadosQuiz = $sqlQuiz->fetchAll();


//perfil
$sqlUser = $PDO->prepare("SELECT * FROM register WHERE id = ?");
$sqlUser->execute(array($id));
$dados = $sqlUser->fetchAll();

@$mensagem=urldecode($_GET["msg"]);
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
<body style=" margin: 0px; padding: 0px; background-color: rgb(51,109,226)">
	

	<div class="grid-container">
		<div class="grid-100" style="padding: 0px;">

<a href="logoff.php">
<div class="sair" >	

<p  style=" text-decoration: none;  color: white;">SAIR</p>
</div>
</a>
	<div class="grid-100 about_me">


<img width="4%" style="border-radius: 50px; padding-bottom: 0px; " align="left" src="fotos/<?=$id?>.jpg" >
    <p style="text-align: left;"><?=$dados[0]["nreal"]?></p>

		 <div   style="text-align: right;"> 	
			<a class="azulEbranco" href="frmEditar.php"> Editar perfil </a>
			<a class="azulEbranco" href="frmCreateQuiz.php"> Criar Quizz </a>
		</div>
		</div>

<p><?php 
echo $mensagem;
 ?></p>
&nbsp
		<dv class="grid-100 people_title" style="padding: 0px">
			<?php  
			foreach ($dadosQuiz as $quizzes) {	
				?>
				<a href="frmQuizId.php?id=<?=$quizzes["id"]?>"><div class="grid-25 people" > 
					 <p class="textoUpImagem" style="text-decoration: none; color: white"> <?=$quizzes["titulo"]?></p>
					 <!-- <p>Criador: <?=$quizzes["nreal"]?></p> -->
						<p><img  style="border-radius: 10px" width="100%" height="100%" src="<?=$quizzes["foto"]?>"></p>
				</div></a>
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