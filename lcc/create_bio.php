<?php

session_start();

//Conexão
	$PDO = new PDO("sqlite:users.db");  //Diretório

	
	// Dados do formulário
	$bio = ($_POST["bio"]);


	// Update
	$sql = $PDO->prepare("UPDATE register SET bio=? WHERE id=?");
	$exec = $sql->execute(array($bio));

	if ($exec)
	{
	   $mensagem = urldecode("Biografia Alterada !");
		header("Location:home.php?msg=$mensagem");
	
	}
	else{
		$mensagem = urldecode("Erro na Bio");
		header("Location:home.php?msg=$mensagem");
		
	}
	
	?>

