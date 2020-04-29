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
	<title>■ 4Quiz - Login ■</title>
	<link rel="stylesheet" href="css/unsemantic-grid-responsive.css"> 
		<link rel="stylesheet" href="css/login.css?time=<?=time()?>">
		<link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
	<link href="https://fonts.googleapis.com/css?family=Orbitron&display=swap" rel="stylesheet">
	 <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <script>
        function validarFormulario()	
        {	  
            if (document.frmLogin.login.value.trim().length < 3) 
            {
                alert("Digite um nome com 3 ou + caracteres");
                document.frmLogin.login.focus();
                return false;
            }
            return true;
        }
	</script>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
	<script>
		function limpaUrl() {     //função
		    urlpg = $(location).attr('href');   //pega a url atual da página
		    urllimpa = urlpg.split("?")[0]      //tira tudo o que estiver depois de '?'
		    window.history.replaceState(null, null, urllimpa); //subtitui a url atual pela url limpa
		}
		setTimeout(limpaUrl, 0)
	</script>
</head>

<body>
	<form name="frmLogin" action="login.php" method="post" onsubmit="return validarFormulario()">

	<div class="grid-container">

<div class="grid-100" style="text-align: center;" >
		<h1 > 4QUIZZ </h1>
			
			<div class="inputWithIcon">
				<input  type="text"  name="login" required="required" maxlength="6" autofocus="autofocus"  placeholder="Login"> 
			</div>

			
			<div class="inputWithIcon">
				<input type="password" name="pass" required="required" placeholder="Senha" autofocus="autofocus"> 
			</div>

			 <!-- <input type="hidden" id="id" name="id" value=""> -->

			 <p>  
				<input type="submit"  value="ENTRAR">
			</p>
		
			 <p>  
				<a style="text-decoration: none; font-family: Calibri; color: white" href="create.php"><h3>Não tenho conta :(</h3></a>
			    </p>
			
				 &nbsp
	
	
<p class="aviso"><?=@urldecode($_GET["msg"])?></p>
	

</div>
	</div>
	</div>
</form>


</body>
</html>