<?php
session_start();

// <!-- Validando o acesso do Usuario -->
if ($_SESSION["acesso"] != true) {
	
	$mensagem = urldecode("Usuário e/ou Senha inválidos");
  	header("Location:index.php?msg=$mensagem"); // L maiúsculo obrigatório
  	exit; //importa (SAIR)
  }

//Conexão
$PDO = new PDO("sqlite:users.db");
$id = $_SESSION["id"];


// //Consulta
// $sqlSelect = $PDO->prepare("SELECT * FROM register WHERE id=?");
// 	$sqlSelect->execute(array($id));
// 	$consulta = $sqlSelect->fetchAll(); 
  ?>  

  <!DOCTYPE html>
  <html>
  <head>
  	<link rel="stylesheet" href="css/unsemantic-grid-responsive.css">
  	<link rel="stylesheet" href="css/style1.css?time=<?=time()?>">
    <link href="https://fonts.googleapis.com/css?family=Orbitron&display=swap" rel="stylesheet">
  	<title>Alterar Foto</title>
    <script>
      function limpaUrl() {     //função
          urlpg = $(location).attr('href');   //pega a url atual da página
          urllimpa = urlpg.split("?")[0]      //tira tudo o que estiver depois de '?'
          window.history.replaceState(null, null, urllimpa); //subtitui a url atual pela url limpa
      }
      setTimeout(limpaUrl, 0) 
    </script>
  </head>
  <body>
    <div class="grid-container">
    <div style="padding-top: 7%" class="grid-100">

<div class="foco">
  	<h1 class="titulo">Foto</h1>
        <?php 
    if ($id == $_SESSION["id"]) {?>
  <form name="frmFoto" method="POST" action="foto.php" enctype="multipart/form-data" >

 <p><input type="file" name="foto" autofocus="autofocus" required="required" <?=@$f?>></p> 


  <input type="hidden" name="id" value="<?=$id?>" <?=@$f?>>

  <p><input type="submit" value="Enviar" <?=@$f?>></p>
  <p><input type="reset" value="Limpar"></p>
  <?php }else{
  $e = "Você não tem permissão";
  $f = "disabled";
}?>
<h3><?=@$e?></h3>
  <p>  
        <a style="color: black" href="home.php">
        ⬅️ Voltar Pagina !</a>
      </p>
</div>

  
</form>
  </body>
  </html>


  