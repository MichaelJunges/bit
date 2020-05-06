<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<style>
	*{
		margin: 0;
		padding: 0;
	}

	.menu
	{
		width: 100%;
		height: 55px;
		background-color: #222;
		font-family: 'Calibri';	
	}
	.menu ul{
		list-style: none;
		position: relative;
	}
	.menu ul li{
		width: 150px;
		float: left;
	}
	.menu a{
		font-weight: 900;
		padding: 15px;
		font-size: 20px;
		display: block;
		text-decoration: none;
		text-align: center;
		background-color: #222;
		color: white;
	}
	.menu ul ul{
		position: absolute;
		visibility: hidden;
	}
.menu ul li:hover ul{
	visibility: visible;
}
.menu a:hover{
	background-color: white;
	color: #008080;
}
.menu ul ul li{
	float: none;
	border-bottom: solid 1px #ccc;
}
.menu ul ul li a{
	background-color: #008080;
}
label[for="bt_menu"]{
	padding: 5px;
	background-color: #008080;
	color: white;
	font-family: Calibri;
	text-align: center;
	font-size: 30px;
	cursor: pointer;
	width: 50px;
	height: 50px;
}
#bt_menu{
	display: none;
}
label[for="bt_menu"]{
	display: none;
}
@media(max-width: 1210px ){
	label[for="bt_menu"]{
		display: block;
	}

	#bt_menu:checked ~ .menu{
		margin-left: 0;

	}

	.menu{
		margin-top: 5px;
		margin-left: -100%;
		transition: all .4s;
	}
	.menu ul li{
		width: 100%;
		float: none;
	}
	.menu ul div{
		width: 100%;
		float: none;
	}
	.menu ul ul{
		width: 100%;
		position: static;
		overflow: hidden;
		max-height: 0;
		transition: all .4s;
	}
	.menu ul li:hover  ul{
		height: auto;
		max-height: 200px;
	}
}
.btpesq{
	font-family: Calibri;
	font-size: 1em;
	border-color: black;
	color: black;
	font-weight: 800;
	text-shadow: all;
	width: 2em;
	height: 1.7em;
	border-radius: 0.5em;
}
</style>
<body>
	<input type="checkbox" id="bt_menu">
	<label for="bt_menu">&#9776;</label>
	<nav class="menu">
		<ul>
			<div class="grid-20">
				<form action="buscar.php"  method="POST">		
			 		<input type="text" name="buscar" placeholder="Procurar Quiz" required="required" style="padding: 5px; border-radius: 10px; border: none; margin-top: 1.3em;">
					<input type="submit" value="Ok" class="btpesq">
			 	</form>
			</div>
			<li><a href="home.php">Home</a></li>
			<li><a href="frmEditar.php">Perfil</a></li>
			<li><a href="#">Quero Criar</a>
				<ul>
					<li><a href="frmCreateQuiz.php">Criar Quiz</a></li>
					<li><a href="">[EM BREVE]</a></li>
				</ul>
			</li>
			<li>
				<a href="#">Categorias</a>
				<ul>
					<li><a href="home.php?categoria">RECENTES</a></li>	
					<?php  
		 				foreach ($dadosCategoria as $quizzes) {	
					?>
						<li>
							<a href="home.php?categoria=<?=$quizzes["categoria"]?>"><?=$quizzes["categoria"]?></a>
						</li>
					<?php
						}
	  				?>
				</ul>	
			</li>
			<li><a href="logoff.php">Sair</a></li>
		</ul>
	</nav>
</body>
</html>