<?php
	session_start();
	$PDO = new PDO("sqlite:admin.db");  //Diretório
	?>
<!DOCTYPE html>
<html>
<head>
	<title>■ HIPOC4MPO ■</title>
	<link rel="stylesheet" href="../css/unsemantic-grid-responsive.css">
	<link rel="stylesheet" href="../css/login.css?time=<?=time()?>">
	<link href="https://fonts.googleapis.com/css?family=Orbitron&display=swap" rel="stylesheet">
</head>

<body>



	<form name="frmLoginAdmin" action="login.php" method="post">

	<div class="grid-container" style="text-align: center;">
		<div class="grid-100">
			<h1>ADMIN</h1>
		 

				<input  type="text" size="30" name="login" required="required" maxlength="6" autofocus="autofocus" placeholder="Login" > 
 <br>
			 
				<input type="password" size="30" name="pass" required="required" placeholder="Senha"> 
		
			 <!-- <input type="hidden" id="id" name="id" value=""> -->
			<p>  
				<input type="submit"  value="Logar">

			<p>  
      <h2>  <a href="../index.php">Volta Página</a></h2>
        <p style=" color: white"><?=@urldecode($_GET["msg"])?></p>	
      </p>


		</div>
	</div>
	</div>
</form>


</body>
</html>