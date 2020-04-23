<?php
session_start();

// <!-- Validando o acesso do Usuario -->
if ($_SESSION["acesso"] != true) {
	
	$mensagem = urldecode("ERRO");
  	header("Location:index.php?msg=$mensagem"); // L maiúsculo obrigatório
  	exit; //importa (SAIR)
  }

//Conexão
$PDO = new PDO("sqlite:users.db");
$id = $_SESSION["id"];


//Consulta
$sqlSelect = $PDO->prepare("SELECT * FROM register WHERE id=?");
	$sqlSelect->execute(array($id));
	$consulta = $sqlSelect->fetchAll(); 
  ?>  

  <!DOCTYPE html>
  <html>
  <head>
  	<link rel="stylesheet" href="css/unsemantic-grid-responsive.css">
  	<link rel="stylesheet" href="css/style1.css?time=<?=time()?>">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
  	<title>Alterar Conta</title>
    <script>
      function limpaUrl() {    
          urlpg = $(location).attr('href'); 
          urllimpa = urlpg.split("?")[0]; 
          window.history.replaceState(null, null, urllimpa);
      }
      setTimeout(limpaUrl, 0); 
    </script>
  </head>
  <body>
    <div class="grid-container">
    <div style="padding-top: 7%" class="grid-100">

<div class="foco">
  	<h1 class="titulo">Editar</h1>
    <?php 
    if ($id == $_SESSION["id"]) {?>
  	<p><form name="frmEditar" method="POST" action="editarConta.php"></p>

 <p><p>E-mail:</p><input type="email" name="email" maxlength="100" autofocus="autofocus" required="required" value=<?=$consulta[0]["email"]?>></p> 

  <p><p>Biografia:</p><input type="text" name="bio" maxlength="" autofocus="autofocus" required="required" pattern="[a-zA-Z0-9- ]+" value="<?=$consulta[0]["bio"]?>"></p> 

<input type="hidden" name="id" value="<?=$id?>">

  <p><input type="submit" value="Confirmar"></p>
<?php }else{
  $e = "Você não tem permissão";
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


  