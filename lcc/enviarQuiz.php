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

	//foto
	$foto = $_POST["foto"];
	$date = date('Y-m-d.H.i.s');
	$conteudo = "fotos_quiz/$date$foto";

	$targ_w = $_POST['w'];
    $targ_h = $_POST['h'];
    $jpeg_quality = 90;

    $src = $_POST['imagem'];
    $img_r = imagecreatefromjpeg($src);
    $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

    imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],$targ_w,$targ_h,$_POST['w'],$_POST['h']);
    imagejpeg($dst_r, $conteudo, $jpeg_quality);

	unlink("fotos_quiz/$foto");
	//fim foto

	$sqlInsert = $PDO->prepare("INSERT INTO quiz (titulo, pergunta, correta, errada, errada2, errada3, id_usuario, foto) VALUES (?,?,?,?,?,?,?,?)");
	$exec = $sqlInsert->execute(array($titulo, $pergunta, $correta, $errada, $errada2, $errada3, $id_usuario, $conteudo));

	if ($exec){
		$msg=urlencode("Quiz criado com sucesso");
		header("Location:home.php?msg=$msg");
  	}else{
  		$msg=urlencode("Falha ao criar quiz, por favor tente novamente");
    	header("Location:home.php?msg=$msg");
  	}
?>