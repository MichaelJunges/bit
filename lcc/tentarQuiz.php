<?php
session_start();
$PDO = new PDO("sqlite:users.db");
$id = $_GET["id"];
$resposta = $_GET["resposta"];

$sqlQuiz = $PDO->prepare("SELECT * FROM quiz WHERE id = ?");
$sqlQuiz->execute(array($id));
$dadosQuiz = $sqlQuiz->fetchAll();

$sqlPergunta = $PDO->prepare("SELECT * FROM pergunta WHERE id_quiz = ?");
$sqlPergunta->execute(array($dadosQuiz[0]["id"]));
$dadosPergunta = $sqlPergunta->fetchAll();

$pergunta = $_SESSION["pergunta"];
@$certa = $dadosPergunta[$pergunta]["certa"];

if ($resposta == $certa) {
	$_SESSION["contador"]++;
	$_SESSION["pergunta"]++;
	$color= "green";
	$msg = "Você acertou";
}else {
	$_SESSION["pergunta"]++;
	$color= "red";
	$msg = "Você errou";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Resposta</title>
</head>
<body style="background-color: <?=$color?>">
<h1 style="color: white"><?=$msg?></h1>
</body>
</html>