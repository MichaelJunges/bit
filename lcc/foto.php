<?php
session_start();

if ($_SESSION["acesso"] != true) {
	
	$mensagem = urldecode("Usuário e/ou Senha inválidos");
  	header("Location:index.php?msg=$mensagem"); // L maiúsculo obrigatório
  	exit; //importa (SAIR)
  }
  
require_once("SimpleImage.php");

$id = $_POST["id"];
$foto = $_FILES["foto"]["tmp_name"];

copy($foto, "fotos/$id.jpg");

$mensagem = urldecode("✔️");
header("Location: frmEditar.php?fotoAtualiza=$mensagem");

  ?>