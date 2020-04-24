<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

if($_SESSION["acesso"] != true) {
	$mensagem = urldecode("Favor logar");
	header("Location:index.php?msg=$mensagem");
	exit;
}
	$PDO = new PDO("sqlite:users.db");
	$titulo = $_POST["titulo"];
	$pergunta = $_POST["pergunta"];
	$correta = $_POST["correta"];
	$errada = $_POST["errada"];
	$errada2 = $_POST["errada2"];
	$errada3 = $_POST["errada3"];
	$id_usuario = $_POST["id"];
	$local = $_FILES["foto"]["tmp_name"];
	$foto = $_FILES['foto']["name"];
	$date = date('Y-m-d.H.i.s');
	$conteudo = "fotos_quiz/$date$foto";
	copy($local, $conteudo);

	$sqlInsert = $PDO->prepare("INSERT INTO quiz (titulo, pergunta, correta, errada, errada2, errada3, id_usuario, foto) VALUES (?,?,?,?,?,?,?,?)");
	$exec = $sqlInsert->execute(array($titulo, $pergunta, $correta, $errada, $errada2, $errada3, $id_usuario, $conteudo));

	if ($exec){
		$msg=urlencode("Sucesso");
		header("Location:home.php?msg=$msg");
  	}else{
  		$msg=urlencode("Erro");
    	header("Location:home.php?msg=$msg");
  	}
