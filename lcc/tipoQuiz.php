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
	<link rel="stylesheet" href="css/style1.css?time=<?=time()?>">
</head>
<body>
	<div class="grid-container">
		<div class="grid-100">
			<h1>Selecione o tipo de quiz</h1>
			<div class="grid-50">
				<a href="frmCreateQuiz.php">
					<h2>Certo e errado</h2>
					<img src="icons/certo_errado.jpg" width="100%">
				</a>
			</div>
			<div class="grid-50">
				<a href="frmCreateQuiz2.php">
					<h2>Personalidade</h2>
					<img src="icons/personalidade.jpg" width="100%">
				</a>
			</div>
		</div>
	</div>
</body>
</html>