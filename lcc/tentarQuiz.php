<?php
$PDO = new PDO("sqlite:users.db");

$id = $_POST["id"];
$resposta = $_POST["resposta"];

$sqlQuiz = $PDO->prepare("SELECT * FROM quiz WHERE id = ?");
$sqlQuiz->execute(array($id));
$dadosQuiz = $sqlQuiz->fetchAll();

$certa = $dadosQuiz[0]["certa"];

if ($resposta == $certa) {
	$mensagem = urlencode("Você acertou");
	$color = urlencode("green");
    header("Location:frmQuizId.php?id=$id&msg=$mensagem&cor=$color");
    exit;
}else {
	$mensagem = urlencode("Você errou");
	$color = urlencode("red");
    header("Location:frmQuizId.php?id=$id&msg=$mensagem&cor=$color");
    exit;
}
?>