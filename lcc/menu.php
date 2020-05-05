<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>QUIZ/<?=$nreal?></title>
 	<link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Barlow&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/unsemantic-grid-responsive.css">
	<link rel="stylesheet" href="css/style1.css?time=<?=time()?>">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script> 

</head><div class="grid-10 mobile-grid-100 gridCategorias" > <!-- DIV LATERAL GRID-10 -->

<div class="grid-100" style="padding: 0px;background-color: "> <!-- DIV CONTA (LATERAL) -->
	<p class="textoUpImagem">Conta</p>
  <a  class="minhasInfo" href="frmEditar.php" ><p class="minhasConta" style="padding: 5px;" >Perfil</p></a>
 	<a class="minhasInfo" href="frmCreateQuiz"><p class="minhasConta" style="padding: 5px">Criar Quiz</p></a>
 	 <a href="logoff.php" style="text-decoration: none;">
		  <p class="textoUpImagem" style="font-size: 15px; text-align: center; background-color:black">SAIR</p>
	</a>
 </div>

<div>  <!-- DIV CATEGORIAS (LATERAL) -->
	<p class="textoUpImagem">Procurar</p>
	<form action="buscar.php" style="margin-left: 5px; " method="POST">		
 		<input type="text" name="buscar" placeholder="Procurar Quiz" required="required" style="    width: 115px;">
 		<input type="submit" value="Ok"  style="width: 115px; font-size: 10px; height: 20px;">
 		</form>
 <p class="textoUpImagem">Categorias</p>  	
		<a href="home.php?categoria" style="text-decoration: none;">
			<p class="categorias"> RECENTES </p>
		</a>		
		<?php  
		  foreach ($dadosCategoria as $quizzes) {	
		?>
		<!-- <a href="home.php?categoria=<?=$categoria?>" style="text-decoration: none;"> -->
	    <a href="home.php?categoria=<?=$quizzes["categoria"]?>" style="text-decoration: none;">
		 <p class="categorias"><?=$quizzes["categoria"]?></p>
		</a>
	 <?php
		  }
	  ?>
     </div> 

<div><!--  DIV SOBRE (LATERAL) -->

 <p class="textoUpImagem">Sobre</p>
	
	<a href="suporte.php" style="text-decoration: none;"><p class="categorias">Tutorial</p></a>
	<a href="suporte.php" style="text-decoration: none;"><p class="categorias">Desenvolvedores</p></a>
	</div>

</div>