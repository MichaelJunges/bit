<?php
session_start();
$PDO = new PDO("sqlite:users.db");
$id = $_POST["id"];
$resposta = $_POST["resposta"];

$sqlQuiz = $PDO->prepare("SELECT * FROM quiz WHERE id = ?");
$sqlQuiz->execute(array($id));
$dadosQuiz = $sqlQuiz->fetchAll();

$sqlPergunta = $PDO->prepare("SELECT * FROM pergunta WHERE id_quiz = ?");
$sqlPergunta->execute(array($dadosQuiz[0]["id"]));
$dadosPergunta = $sqlPergunta->fetchAll();

$pergunta = $_POST["pergunta"];
$certa = $dadosPergunta[$pergunta]["certa"];

if ($resposta == $certa) {
	$_SESSION["contador"]++;
	$_SESSION["pergunta"]++;
    header("Location:frmQuizId.php?id=$id");
    exit;
}else {
	$_SESSION["pergunta"]++;
	header("Location:frmQuizId.php?id=$id");
    exit;
}
?>