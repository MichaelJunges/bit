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
</head>
<body>
	<div>
		<h1 style="color: <?=$e?>"><?=$escreve?></h1>
	</div>
</body>
</html>