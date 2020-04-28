<?php
$PDO = new PDO("sqlite:users.db");
$contador = $_POST["contador"];
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
	$contador++;
	$pergunta++;
    header("Location:frmQuizId.php?id=$id&pergunta=$pergunta&contador=$contador");
    exit;
}else {
	$pergunta++;
	header("Location:frmQuizId.php?id=$id&pergunta=$pergunta&contador=$contador");
    exit;
}
?>