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
		height: 50px;
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
	color: rgb(51,109,226);
}
.menu ul ul li{
	float: none;
	border-bottom: solid 1px #ccc;
}
.menu ul ul li a{
	background-color: rgb(51,109,226);
}
label[for="bt_menu"]{
	padding: 5px;
	background-color: rgb(51,109,226);
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
@media(max-width: 800px ){
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
	.menu ul ul{
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

</style>
<body>


<input type="checkbox" id="bt_menu">
<label for="bt_menu">&#9776;</label>

		<nav class="menu">
			
			<ul>
					<div class="grid-15" style="text-align: right;">
		<form style="text-align: left;" action="buscar.php"  method="POST">		
 		<input type="text" name="buscar" placeholder="Procurar Quiz" required="required" style="padding: 5px; border-radius: 10px; border: none; margin-top: 15px;">
 		<input hidden="hidden" type="submit" value="Ok" >
 		</form>
				</div>
				<li><a href="frmEditar.php">Perfil</a></li>
				<li><a href="#">Quero Criar</a>
					<ul>
						<li><a href="frmCreateQuiz.php">Criar Quiz</a></li>
						<li><a href="">[EM BREVE]</a></li>
					</ul>
				</li>
				<li><a href="#">Categorias</a>
						<ul>
						<li><a href="home.php?categoria">RECENTES</a></li>	
							<?php  
		 					 foreach ($dadosCategoria as $quizzes) {	
							?>
						<li><a href="home.php?categoria=<?=$quizzes["categoria"]?>"><?=$quizzes["categoria"]?></a></li>
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