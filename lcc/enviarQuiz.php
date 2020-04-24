<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

if($_SESSION["acesso"] != true) {
	$mensagem = urldecode("Favor logar");
	header("Location:index.php?msg=$mensagem");
	exit;
}
	$PDO = new PDO("sqlite:users.db");
	$titulo = $_POST["titulo"];
	$pergunta = $_POST["pergunta"];
	$correta = $_POST["correta"];
	$errada = $_POST["errada"];
	$errada2 = $_POST["errada2"];
	$errada3 = $_POST["errada3"];
	$id_usuario = $_POST["id"];
	$local = $_FILES["foto"]["tmp_name"];
	$foto = $_FILES['foto']["name"];
	$date = date('Y-m-d.H.i.s');
	$conteudo = "fotos_quiz/$date$foto";
	copy($local, $conteudo);

	$sqlInsert = $PDO->prepare("INSERT INTO quiz (titulo, pergunta, correta, errada, errada2, errada3, id_usuario, foto) VALUES (?,?,?,?,?,?,?,?)");
	$exec = $sqlInsert->execute(array($titulo, $pergunta, $correta, $errada, $errada2, $errada3, $id_usuario, $conteudo));

	if ($exec){
    	$escreve = "Quiz criado com sucesso";
    	$e = "green";
  	}else{
    	$escreve = "Erro ao criar o quiz, por favor tente novamente.";
    	$e = "red";
  	}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Quiz</title>
	<link rel="stylesheet" href="css/unsemantic-grid-responsive.css">
	<link rel="stylesheet" href="css/style1.css?time=<?=time()?>">
	<link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Press Start 2P', cursive;" style=" margin: 0px; padding: 0px ";>
	<div class="grid container">
		<div class="grid-20 menu"><a href="home.php">Início</a></div>
		<div class="grid-20 menu"><a href="frmCreateQuiz.php">Adicionar + Quiz</a></div>
		<div class="grid-20 menu">&nbsp</div>
		<div class="grid-20 menu">&nbsp</div>
		<div class="grid-20 menu"><a href="logoff.php">Sair</a></div>
		<h1 style="color: <?=$e?>"><?=$escreve?></h1>
	</div>
</body>
</html>