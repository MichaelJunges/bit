<?php

session_start();

//Conexão
	$PDO = new PDO("sqlite:users.db");  //Diretório

	
	// Dados do formulário
	$login = $_POST["login"];
	$pass = md5($_POST["pass"]);
	$email = ($_POST["email"]);
	$sexo = ($_POST["sexo"]);
	$nreal = ($_POST["nreal"]);


	// Insert
	$sql = $PDO->prepare("INSERT INTO register (nreal, login, pass, email, sexo) VALUES (?, ?, ?, ?, ?)");
	$exec = $sql->execute(array($nreal, $login, $pass, $email, $sexo));
	
	if ($exec)
	{
	   $mensagem = urldecode("Cadastrado com Sucesso !");
		header("Location:index.php?msg=$mensagem");
	
	}
	else{
		$mensagem = urldecode("Erro ! Email/Login já Cadastrados");
		header("Location:index.php?msg=$mensagem");
		
	}
	?>

