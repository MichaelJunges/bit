<?php
session_start();

if($_SESSION["acesso"] != true) {

	$mensagem = urldecode("Erro");
	header("Location.index.php?msg=$mensagem");
	exit;
}

$PDO = new PDO("sqlite:users.db");
$id = $_GET["id"];

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/style1.css?time=<?=time()?>">
	 <link rel="stylesheet" href="css/unsemantic-grid-responsive.css">
	 <link href="https://fonts.googleapis.com/css?family=Orbitron&display=swap" rel="stylesheet">
</head>
<body>
	<form name="frmCreateQuiz" action="enviarQuiz.php" method="post">

	 <div class="grid-container">
	 	<div class="grid-100">
	 		<div class="grid-50"></div>
	 		<h1 class="titulo">CRIE SEU QUIZ</h1>

	 		<p class="quiz"> 
				Correta:<br /> 
				<input  type="text" size="30" name="correta" required="required" maxlength="20" autofocus="autofocus" > 
			</p> 	

			<p class="quiz"> 
				Errada:<br /> 
				<input  type="text" size="30" name="errada" required="required" maxlength="20" autofocus="autofocus" > 
			</p>

			<p class="quiz"> 
				Errada:<br /> 
				<input  type="text" size="30" name="errada" required="required" maxlength="20" autofocus="autofocus" > 
			</p>

			<p class="quiz"> 
				Errada:<br /> 
				<input  type="text" size="30" name="errada" required="required" maxlength="20" autofocus="autofocus" > 
			</p>

			<input type="hidden" name="id" value="<?=$id?>">

			<p class="titulo">  
				<input type="submit"  value="FINALIZAR">
			</p>	

</form>
	 	</div>
	 	</div>
	 </div>
</body>
		
	

</html>