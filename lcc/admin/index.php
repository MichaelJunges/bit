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

<body>
	<form name="frmLoginAdmin" action="login.php" method="post">

	<div class="grid-container">
		<div style="padding-top: 5%" class="grid-100">
			<p> 

				<input  type="text" size="30" name="login" required="required" maxlength="6" autofocus="autofocus" placeholder="Login" > 
			</p> 
			<p> 
				<input type="password" size="30" name="pass" required="required" placeholder="Senha"> 
			</p>
			 <!-- <input type="hidden" id="id" name="id" value=""> -->
			<p>  
				<input type="submit"  value="Logar">

			<p style=" color: purple"><?=@urldecode($_GET["msg"])?></p>

			<p>  
        <a style="color: black" href="../index.php">
        ⬅️</a>

        <p style=" color: white"><?=@urldecode($_GET["msg"])?></p>	
      </p>


		</div>
	</div>
	</div>
</form>


</body>
</html>