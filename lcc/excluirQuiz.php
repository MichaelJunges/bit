<?php
	session_start();
	if ($_SESSION["acesso"] != true) {
		$mensagem = urlencode("Você precisa logar");
		header("Location:index.php?msg=$mensagem");
		exit;
	}
	$PDO = new PDO("sqlite:users.db");
	$id = $_GET["id"];
	$id_usuario = $_SESSION["id"];

	$sqlQuiz = $PDO->prepare("SELECT * FROM quiz WHERE id = $id");
	$sqlQuiz->execute();
	$dadosQuiz = $sqlQuiz->fetchAll();

	if ($id_usuario != $dadosQuiz[0]["id_usuario"]) {
		header("Location:mycriados.php");
		exit;
	}

	@$confirma = $_GET["confirma"];
	if ( $confirma == 1 ){
		unlink($dadosQuiz[0]['foto']);
		$sqlDelete = $PDO->prepare("DELETE FROM quiz WHERE id=?");
		$del = $sqlDelete->execute(array($id));
		$mensagem = urlencode("Quiz excluido com sucesso");
		header("Location:mycriados.php?msg=$mensagem");
		exit;
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Excluir</title>
	</head>
    
	<body>	
		<script>
		if (confirm("Deseja Excluir o quiz <?=$dadosQuiz[0]["titulo"]?>?")) {
			// ok
			window.location.href = "excluirQuiz.php?confirma=1&id=<?=$id?>";
		} else {
			// cancelar
			window.location.href = "mycriados.php";
		}
		</script>		
	</body>
</html>