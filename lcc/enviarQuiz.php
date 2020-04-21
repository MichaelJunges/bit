<?php
session_start();

if($_SESSION["acesso"] != true) {

	$mensagem = urldecode("Favor logar");
	header("Location.index.php?msg=$mensagem");
	exit;
}

	$PDO = new PDO("sqlite:users.db");

	$pergunta = $_POST["pergunta"];
	$correta = $_POST["correta"];
	$errada = $_POST["errada"];
	$errada2 = $_POST["errada2"];
	$errada3 = $_POST["errada3"];
	$id_usuario = $_POST["id"];

	$sqlInsert = $PDO->prepare("INSERT INTO quiz (pergunta, correta, errada, errada2, errada3, id_usuario) VALUES (?,?,?,?,?,?)");
	$exec = $sqlInsert->execute(array($pergunta, $correta, $errada, $errada2, $errada3, $id_usuario));

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
	<link href="https://fonts.googleapis.com/css?family=Orbitron&display=swap" rel="stylesheet">
</head>
<body>
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