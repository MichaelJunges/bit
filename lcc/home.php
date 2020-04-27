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
	

	<div class="grid-container">
<div class="grid-100">

<div class="grid-33" style="padding: 0px;">
<a href="frmEditar.php" style="text-decoration: none;">
<div class="grid-100 criarEditar" >	
<p >Editar Conta</p>
</div>
</a>
</div>

<div class="grid-33" style="padding: 0px;">
<a href="frmCreateQuiz.php" style="text-decoration: none;">
<div class="grid-100 criarEditar" >	
<p>Criar Quiz</p>
</div>
</a>
</div>

<div class="grid-33" style="padding: 0px;">
<a href="logoff.php" style="text-decoration: none;">
<div class="grid-100 criarEditar" >	
<p >Sair</p>
</div>
</a>
</div>


</div>

	<div class="grid-100 about_me">

<div class="grid-60"> 
 <a href="frmFoto.php?id=<?=$id?>"><img  width="6%" style="border-radius: 10px; padding-bottom: 0px; padding-right: 10px;" align="left" src="fotos/<?=$id?>.jpg"  > </a>
    <p class="minhasInfo" >Nome: <?=$dados[0]["nreal"]?></p>
     <p class="minhasInfo">Bio: <?=$dados[0]["bio"]?></p>
</div>	
</div>


<!-- <p><?php 
echo $mensagem;
 ?></p> -->
&nbsp
		<div class="grid-100 people_title" style="padding: 0px">
			<?php  
			foreach ($dadosQuiz as $quizzes) {	
				?>
				<a href="frmQuizId.php?id=<?=$quizzes["id"]?>"><div class="grid-25 people" > 
					 <p class="textoUpImagem" style="text-decoration: none; color: white"> <?=$quizzes["titulo"]?></p>

						<p><img  style="border-radius: 10px" width="100%" height="100%" src="<?=$quizzes["foto"]?>"></p>
				</div></a>
				<?php
			}
			?>
</div>
</body>
</html>