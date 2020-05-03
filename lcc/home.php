<?php 

session_start();

if ($_SESSION["acesso"] != true)
 {
	// Não está autenticado
	$mensagem = urlencode("Você precisa fazer login!");
	header("Location:index.php?msg=$mensagem");
	exit;
 }

//Conexão com o banco de dados
 $PDO = new PDO("sqlite:users.db");

 $login = $_SESSION['login'];
 $id = $_SESSION['id'];
 $nreal = $_SESSION['nreal'];
 $email = $_SESSION['email'];
 $bio = $_SESSION['bio'];
 $_SESSION["contador"] = 0;
 $_SESSION["pergunta"] = 0;

// MOSTRA quizes recentes
 $sqlQuiz = $PDO->prepare("SELECT q.id, p.nreal, p.email, q.titulo, q.foto, q.categoria FROM quiz q, register p WHERE q.id_usuario = p.id AND login != '$login'");
 $sqlQuiz->execute();
 $dadosQuiz = $sqlQuiz->fetchAll();

// $PDO categorias lateral
 @$categoria = $_GET['categoria'];
 $sqlQuiz = $PDO->prepare("SELECT DISTINCT categoria FROM quiz where categoria!='' ORDER BY categoria ASC");
 $sqlQuiz->execute();
 $dadosCategoria = $sqlQuiz->fetchAll();

// $PDO pega por categorias
 $sqlCarrega = $PDO->prepare("SELECT * FROM quiz where categoria=='$categoria'");
 $sqlCarrega->execute();
 $carregaCategoria = $sqlCarrega->fetchAll();


?>

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

</head>
<body style=" margin: 0px; padding: 0px; background-color: rgb(51,109,226)">
	  
<!-- <iframe hidden="hidden" src="https://www.youtube.com/embed/5Mj8AlkKISw?autoplay=1;mute=1'"> </iframe> -->
	
<div class="grid-100" style="padding-top: 15PX;"> <!-- DIV PRINCIPAL GRID-100 -->

<div class="grid-10 mobile-grid-100 gridCategorias" > <!-- DIV LATERAL GRID-10 -->

<div class="grid-100" style="padding: 0px;background-color: "> <!-- DIV CONTA (LATERAL) -->
	<p class="textoUpImagem">Conta</p>
  <a  class="minhasInfo" href="frmEditar.php" ><p class="minhasConta" style="padding: 5px;" >Perfil</p></a>
 	<a class="minhasInfo" href="tipoQuiz.php"><p class="minhasConta" style="padding: 5px">Criar Quiz</p></a>
 	 <a href="logoff.php" style="text-decoration: none;">
		  <p class="textoUpImagem" style="font-size: 15px; text-align: center; background-color:black">SAIR</p>
	</a>
 </div>

<div>  <!-- DIV CATEGORIAS (LATERAL) -->
 <p class="textoUpImagem">Categorias</p> 
		<a href="home.php?categoria" style="text-decoration: none;">
			<p class="categorias"> RECENTES <!-- <img src="icons/estrela.png" width="25px" height="25px" style="vertical-align: middle;"> --></p>
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
<div class="grid-90 " style="padding: 0px; display: block;"><!--  DIV DOS QUIZ GRID-90 -->

<div class="grid-100"  >	<!-- DIV QUE CARREGA POR CATEGORIA -->
	<h1  style="padding: 0px; margin: 0px; background-color: white; border-radius: 20px;"><?=$categoria?></h1>
    <?php  
      foreach ($carregaCategoria as $recaregados) {  
    ?>
      <a style="text-decoration: none;" href="frmQuizId.php?id=<?=$recaregados["id"]?>">
        <div class="grid-20 mobile-grid-100 people" style="background-color: black;" > 
        <p class="textoUpImagem" style="text-decoration: none; color: white">
          <?=$recaregados["titulo"]?>   
        </p>
        <p >
          <img class="imagemQuiz" width="100%" height="100%" src="<?=$recaregados["foto"]?>">
        </p>
        <p class="textoDownImagem"><?=$recaregados["categoria"]?></p>
        </p>
      </a>
       </div>
    <?php
      }
    ?>
 </div>
<?php if (empty(@$categoria)) 
{
?>
<div class="grid-100"> <!-- DIV QUE CARREGA QUIZ RECENTES (categoria=) -->
	<h1  style="padding: 0px; margin: 0px; background-color: white; border-radius: 20px;">+ RECENTES </h1>
		<?php  
		  foreach ($dadosQuiz as $quizzes) {	
		?>

		  <a style="text-decoration: none;" href="frmQuizId.php?id=<?=$quizzes["id"]?>">
		  	<div class="grid-20 mobile-grid-100 people"  > 
				<p class="textoUpImagem" >
				  <?=$quizzes["titulo"]?>		
				</p>
				<p >
				  <img class="imagemQuiz" width="100%" height="100%" src="<?=$quizzes["foto"]?>">
				</p>
				<p class="textoDownImagem"><?=$quizzes["categoria"]?></p>
				</p>
		  </a>
		  </div>
		<?php
		  }
		?>
		</div>
		<?php }?>
		
 </div>
</body>
</html>