<?php
	session_start();
	$PDO = new PDO("sqlite:admin.db");  //Diretório
	?>
<!DOCTYPE html>
<html>
<head>
	<title>■ HIPOC4MPO ■</title>
	<link rel="stylesheet" href="../css/unsemantic-grid-responsive.css">
	<link rel="stylesheet" href="../css/style1.css?time=<?=time()?>">
	<link href="https://fonts.googleapis.com/css?family=Orbitron&display=swap" rel="stylesheet">
</head>

<body style=" background-image: none; background-color: yellow " >
	<form name="frmLoginAdmin" action="login.php" method="post">

	<div class="grid-container">
		<div style="padding-top: 5%" class="grid-100">

<div class="foco">
			<div style="padding: 10px;">
			<p>Desenvolvido por:</p>
			<a href="https://www.facebook.com/luancarlos.castoldi"><img src="../logos/logo2.png" width="30%" ></a>  
			</div>
			 <!-- <h1 class="titulo">HIPOC4MPO</h1>  -->
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
				<input style="background-color: yellow" type="submit"  value="LOGAR ADMIN">

			<p style=" color: purple"><?=@urldecode($_GET["msg"])?></p>

			<p>  
        <a style="color: black" href="../index.php">
        ⬅️ Voltar Pagina !</a>

        <p style=" color: white"><?=@urldecode($_GET["msg"])?></p>	
      </p>


		</div>
	</div>
	</div>
</form>


</body>
</html>