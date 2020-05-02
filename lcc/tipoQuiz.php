<?php
session_start();

if($_SESSION["acesso"] != true) {
    $mensagem = urldecode("Erro");
    header("Location:index.php?msg=$mensagem");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tipo de quiz</title>
	<link rel="stylesheet" href="css/unsemantic-grid-responsive.css">
	<link rel="stylesheet" href="css/login.css?time=<?=time()?>">
	<link rel="stylesheet" href="css/style1.css?time=<?=time()?>">
</head>
<body>
	<a href="home.php?categoria"><img src="icons/seta2.png" width="3%">
	<div class="grid-container-100" style="text-align: center; ">
		<div class="grid-100" >
			
			<div class="grid-50 tipoQuiz" style="height: 350px">
				<a href="frmCreateQuiz.php">
					<p class="textoUpImagem">CERTO / ERRADO</p>
					<img src="icons/certo.png" width="400px">
				</a>

				<p style="color:black">Pontue o máximo que conseguir !</p>
			</div>
			<div class="grid-50 tipoQuiz" style="height: 350px" >
				<a href="frmCreateQuiz2.php">
					<p class="textoUpImagem">PERSONALIDADE</p>
					<img src="icons/perso.png" width="240px">
				</a>
				<p style="color:black">Teste AQUI sua Personalidade !</p>
			</div>
		</div>
	</div>
</body>
</html>