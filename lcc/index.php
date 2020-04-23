<?php
	session_start();
	$PDO = new PDO("sqlite:users.db");
	if(@$_SESSION["acesso"] == true) {
		header("Location:home.php");
		exit;
	}
	?>
<!DOCTYPE html>
<html>
<head>
	<title>■ Quizz Teste ■</title>
	<link rel="stylesheet" href="css/unsemantic-grid-responsive.css">
	<link rel="stylesheet" href="css/style1.css?time=<?=time()?>">
	<link href="https://fonts.googleapis.com/css?family=Orbitron&display=swap" rel="stylesheet">
	 <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <script>
        function validarFormulario()	
        {	  
            if (document.frmLogin.login.value.trim().length < 4) 
            {
                alert("Digite um nome com 4 ou + caracteres");
                document.frmLogin.login.focus();
                return false;
            }
            return true;
        }
</script>
<script>
	function limpaUrl() {    
	    urlpg = $(location).attr('href'); 
	    urllimpa = urlpg.split("?")[0] 
	    window.history.replaceState(null, null, urllimpa);
	}
	setTimeout(limpaUrl, 0) 
</script>
</head>

<body>
	<form name="frmLogin" action="login.php" method="post" onsubmit="return validarFormulario()">

	<div class="grid-container">
		<div style="padding-top: 5%" class="grid-100">

<div class="foco">
			<!-- <div style="padding: 10px;">
			<p>Desenvolvido por:</p>
			<a href="https://www.facebook.com/luancarlos.castoldi"><img src="logos/logo2.png" width="30%" ></a>  
			</div> -->
	<p>&nbsp</p>
			<h1 class="titulo">4Quizz</h1>
			
			<p> 
				Login:<br /> 
				<input  type="text" size="30" name="login" required="required" maxlength="6" autofocus="autofocus" > 
			</p> 
			<p> 
				Senha:<br /> 
				<input type="password" size="30" name="pass" required="required"> 
			</p>
			 <!-- <input type="hidden" id="id" name="id" value=""> -->
			<p>  
				<input type="submit"  value="ENTRAR">
			</p>
				<p>  
				<a style="color:rgb(51,109,226)" href="create.php">CRIAR CONTA</a>
			</p>
	
<p style="color: red; font-style: 20px; "><?=@urldecode($_GET["msg"])?></p>
	

<!-- teste -->

		</div>
	</div>
	</div>
</form>


</body>
</html>