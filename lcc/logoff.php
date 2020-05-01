<?php
	session_start();
	if ($_SESSION["acesso"] != true) {
		$mensagem = urlencode("Você precisa logar");
		header("Location:index.php?msg=$mensagem");
		exit;
	}
	@$confirma = $_GET["confirma"];
	if ( $confirma == 1 ){
		session_destroy();
		$mensagem = urlencode("Deslogado com sucesso");
		header("Location:index.php?msg=$mensagem");
		exit;
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Sair</title>
        <link rel="stylesheet" href="estilo.css">
	</head>
    
	<body>	
		<script>
		if (confirm("Deseja deslogar?")) {
			// ok
			window.location.href = "logoff.php?confirma=1";
		} else {
			// cancelar
			window.location.href = "home.php";
		}
		</script>		
	</body>
</html>