<?php

session_start();
if ($_SESSION["acesso"] != true) {
	
	$mensagem = urldecode("Usuário e/ou Senha inválidos");
  	header("Location:index.php?msg=$mensagem"); // L maiúsculo obrigatório
  	exit; //importa (SAIR)
  }

//Conexão
  $PDO = new PDO("sqlite:users.db"); 

  
// Dados do Cliente
  	
  $id = $_POST["id"];
  //$login = $_POST["login"];
  $email = $_POST["email"];
  $bio = $_POST["bio"];

  //Update
	$sqlUpdate = $PDO->prepare("UPDATE register SET  email=?, bio=? WHERE id=?");
  	$exec = $sqlUpdate->execute(array($email, $bio, $id));


if ($exec)
  {
     $mensagem = urldecode("Editado com Sucesso!");
    header("Location:home.php?msg=$mensagem");
  
  }
  else{
    $mensagem = urldecode("Erro X");
    header("Location:home.php?msg=$mensagem");
    
  }