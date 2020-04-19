<?php 
session_start();

if ($_SESSION["acessoAdmin"] != true)
{
		// Não está autenticado
	$mensagem = urlencode("Você precisa fazer login :)!");
	header("Location:index.php?msg=$mensagem");
	exit;
}

$PDO = new PDO("sqlite:admin.db");
$PDO = new PDO("sqlite:../users.db");

//$login = $_SESSION['login'];
// $id = $_SESSION['id'];


$sqlOutros = $PDO->prepare("SELECT * FROM register");
$sqlOutros->execute();
$dadosOutros = $sqlOutros->fetchAll();

?>


<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Orbitron&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Barlow&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../css/unsemantic-grid-responsive.css">
	<link rel="stylesheet" href="../css/style1.css?time=<?=time()?>">
	<title>Principal/<?=$nreal?></title>
</head>
<body style=" margin: 0px; padding: 0px; background-image: none; background-color: yellow " >
	

	<div class="grid-container">
		<div class="grid-100">

			<div class="grid-25 about_me">
			<p></p>
			<div style="text-align: left;">
		
			</div>
			<p><a href="logoff.php" style="background-color:  #363636; border-radius: 30px; text-decoration: none; padding: 4px; color: white; ;" >SAIR ❌</a> </p>
			<p></p>
			
			<p style=" color: white"><?=@urldecode($_GET["msg"])?></p>	
		</div>
		<div class="grid-75 people_title">
			<table>
				<thead>
					<tr>
						<th>Id</th>
						<th>Login</th>
						<th>Senha</th>
						<th>Nome Real</th>
						<th>Biografia</th>
						<th>Sexo</th>
						<th>Email</th>
						<th>Excluir</th>
					</tr>
				</thead>
			<tbody>
				<?php  
			foreach ($dadosOutros as $outros) {	
		?>
			<tr>
				<td><?=$outros["id"]?></td>
				<td><?=$outros["login"]?></td>
				<td><?=$outros["pass"]?></td>
				<td><?=$outros["nreal"]?></td>
				<td><?=$outros["bio"]?></td>
				<td><?=$outros["sexo"]?></td>
				<td><?=$outros["email"]?></td>
				<td><a href="excluir.php?id=<?=$outros["id"]?>">Excluir</a></td>
				</tr>
				<?php
				}
			?>
		</div>
	</div>
</div>
</div>
</div>




</form>
</body>
</html>