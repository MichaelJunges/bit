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
	$id_usuario = $_POST["id"];
	$categoria = $_POST["categoria"];
	
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

	$sqlInsert = $PDO->prepare("INSERT INTO quiz (titulo, id_usuario, foto, categoria) VALUES (?,?,?,?)");
	$exec = $sqlInsert->execute(array($titulo, $id_usuario, $conteudo, $categoria));

	$sql = $PDO->prepare("SELECT id FROM quiz ORDER BY id DESC LIMIT 1");
	$sql->execute();
	$quiz = $sql->fetchAll();
	$id_quiz = $quiz[0]["id"];

	if (isset($_POST["quantidadePerg"])) {
		$qtPerg = $_POST["quantidadePerg"];
		for ($i=1; $i < $qtPerg; $i++) { 
			$pergunta = $_POST["pergunta$i"];
			$certa = $_POST["certa$i"];

			$sqlInsert = $PDO->prepare("INSERT INTO pergunta (texto, certa, id_quiz) VALUES (?,?,?)");
			$execP = $sqlInsert->execute(array($pergunta, $certa, $id_quiz));

			$sqlP = $PDO->prepare("SELECT id FROM pergunta ORDER BY id DESC LIMIT 1");
			$sqlP->execute();
			$per = $sqlP->fetchAll();
			$id_pergunta = $per[0]["id"];

			for ($x=1; $x < 5; $x++) {
				$z++;
				$resposta = $_POST["resposta$z"];
				$sqlInsert = $PDO->prepare("INSERT INTO resposta (resposta, id_quiz, id_pergunta, numero) VALUES (?,?,?,?)");
				$execR = $sqlInsert->execute(array($resposta, $id_quiz, $id_pergunta, $x));
			}
		}
	}else{
		$pergunta = $_POST["pergunta1"];
		$certa1 = $_POST["certa1"];

		$sqlInsert = $PDO->prepare("INSERT INTO pergunta (texto, certa, id_quiz) VALUES (?,?,?)");
		$execP = $sqlInsert->execute(array($pergunta, $certa1, $id_quiz));

		$sqlP = $PDO->prepare("SELECT id FROM pergunta ORDER BY id DESC LIMIT 1");
		$sqlP->execute();
		$per = $sqlP->fetchAll();
		$id_pergunta = $per[0]["id"];

		for ($x=1; $x < 5; $x++) {
			$z++;
			$resposta = $_POST["resposta$z"];
			$sqlInsert = $PDO->prepare("INSERT INTO resposta (resposta, id_quiz, id_pergunta, numero) VALUES (?,?,?,?)");
			$execR = $sqlInsert->execute(array($resposta, $id_quiz, $id_pergunta, $x));
		}
	}

	if ($exec && $execR && $execP){
		$msg=urlencode("Quiz criado com sucesso");
		header("Location:home.php?categoria=");  
		// header("Location:home.php?msg=$msg");
		exit;
  	}else{
  		$msg=urlencode("Falha ao criar quiz, por favor tente novamente");
    	header("Location:home.php?categoria=?msg=$msg");
    	exit;
  	}
?>