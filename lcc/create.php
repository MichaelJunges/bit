<?php

session_start();
	$PDO = new PDO("sqlite:./users.db");  //Diretório
	?>
<!DOCTYPE html>
<html>
<head>
	<title>■ NOVA CONTA ■</title>
	<link rel="stylesheet" href="css/unsemantic-grid-responsive.css">
	<link rel="stylesheet" href="css/login.css">
	 <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
	 <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        function validar4()	
        {	  
            if (document.frmLogin.login.value.trim().length < 3) 
            {
                alert("Digite um nome FICTICIO com 3 ou + caracteres");
                document.frmLogin.login.focus();
                return false;
            }
            return true;
        }
</script>
</head>

<body >
	<form name="frmCreate" action="create_u.php" method="post" onsubmit="return validar4()">

	<div class="grid-container">
		<div style="padding-top: 1%" class="grid-100">

<div style="text-align: center;">
			<h1>REGISTRO</h1>
			<p> 
				<input type="text" size="30" name="login" required="required" maxlength="6" pattern="[a-zA-Z0-9-]+" placeholder="Login"> 
			</p>
			<p> 
				<input type="text" size="30" name="nreal" required="required" maxlength="50" pattern="[a-zA-Z- ]+" placeholder="Nome Real"> 
			</p>
			<p> 
				<input type="email" size="30" name="email" maxlength="50" required="required" placeholder="Email"> 
			</p> 
			<p> 
				<input type="password" size="30" name="pass" required="required" pattern="[a-zA-Z0-9-]+" placeholder="Senha"> 
			</p>
			<p class="radio" >
				<input  type="radio" id="m" name="sexo" required="required" value="F">Feminino
                    <input type="radio" id="f" name="sexo" value="M"> Masculino

			</p>
  &nbsp
			<p>  
				<input type="submit"  value="REGISTRAR">
			</p>
			
			<p>  
				<a class="aviso" style="color: white; text-decoration: none;" href="index.php">
				Voltar Pagina</a>
			</p>
		</div>
	</div>
</div>
</form>


</body>
</html>