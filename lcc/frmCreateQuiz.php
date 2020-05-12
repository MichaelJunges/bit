<?php
session_start();

if($_SESSION["acesso"] != true) {
	$mensagem = urldecode("Erro");
	header("Location:index.php?msg=$mensagem");
	exit;
}
$PDO = new PDO("sqlite:users.db");
$id = $_SESSION["id"];

// $PDO categorias lateral
 @$categoria = $_GET['categoria'];
 $sqlQuiz = $PDO->prepare("SELECT DISTINCT categoria FROM quiz where categoria!='' ORDER BY categoria ASC");
 $sqlQuiz->execute();
 $dadosCategoria = $sqlQuiz->fetchAll();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Criar Quiz</title>
	<link rel="stylesheet" href="css/login.css?time=<?=time()?>">
	<link rel="stylesheet" href="css/unsemantic-grid-responsive.css">
	<link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
    	function readURL(input) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        $('#ImageCrop').attr('src', e.target.result)
	    };
	    reader.readAsDataURL(input.files[0]);
	} 
	function mostraImagem(){
	    $('input[type=file]').each(function(index){
	        if ($('input[type=file]').eq(index).val() != ""){
	            readURL(this);
	        }
	    });
	}
    </script>
</head>
<body >
	<?php 
			include('menu2.php');
	 ?>

	<div class="grid-container" style="text-align: center;">
<div>

</div>


		<div class="grid-100">
			<div class="grid-50"></div>
			<h1 style="color: white">
<a href="tipoQuiz.php"></a>Seu Quiz precisa de uma foto 📷</h1>
		<form name="frmCreateQuiz" action="frmCrQuiz.php" method="POST" enctype="multipart/form-data" >
				 <p class="titulo">  
		        <input type="submit" value="PRÓXIMO" id="proximo">
		    </p>
			<p class="quiz">
		        <input name="foto" type="file" accept=".jpg, .jpeg" required="required" onchange="mostraImagem()" >
		    </p><br>
		    <p><img id="ImageCrop" width="50%"></p>
		    </form>
    	</div>
    </div>
</body>
</html>