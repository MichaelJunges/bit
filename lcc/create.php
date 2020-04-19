<?php

session_start();
	$PDO = new PDO("sqlite:./users.db");  //Diretório
	?>
<!DOCTYPE html>
<html>
<head>
	<title>■ NOVA CONTA ■</title>
	<link rel="stylesheet" href="css/unsemantic-grid-responsive.css">
	<link rel="stylesheet" href="css/style1.css">
	<link href="https://fonts.googleapis.com/css?family=Orbitron&display=swap" rel="stylesheet">
    <script>
        function validar4()	
        {	  
            if (document.frmLogin.login.value.trim().length < 4) 
            {
                alert("Digite um nome FICTICIO com 4 ou + caracteres");
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

<div class="foco">
			<h1 class="titulo">Registro</h1>
			<p> 
				Login:<br /> 
				<input type="text" size="30" name="login" required="required" maxlength="6" pattern="[a-zA-Z0-9-]+"> 
			</p>
			<p> 
				Nome Real:<br /> 
				<input type="text" size="30" name="nreal" required="required" maxlength="50" pattern="[a-zA-Z- ]+"> 
			</p>
			<p> 
				Senha:<br /> 
				<input type="password" size="30" name="pass" required="required" pattern="[a-zA-Z0-9-]+"> 
			</p>
			<p> 
				Email:<br /> 
				<input type="email" size="30" name="email" maxlength="50" required="required"> 
			</p> 	
			<p>
				<input type="radio" id="m" name="sexo" required="required" value="F">Feminino
                    <input type="radio" id="f" name="sexo" value="M">Masculino
			</p>

			<p>  
				<input type="submit"  value="Registrar">
			</p>
			
			<p>  
				<a style="color: black" href="index.php">
				⬅️ Voltar Pagina !</a>
			</p>
		</div>
	</div>
</div>
</form>


</body>
</html>