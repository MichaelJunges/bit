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
?>  

  <!DOCTYPE html>
  <html>
  <head>
  	<link rel="stylesheet" href="css/unsemantic-grid-responsive.css">
  	<link rel="stylesheet" href="css/login.css?time=<?=time()?>">
    <link href="https://fonts.googleapis.com/css?family=Orbitron&display=swap" rel="stylesheet">
  	<title>Alterar Foto</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
       <!-- <script>
    function limpaUrl() {     //função
        urlpg = $(location).attr('href');   //pega a url atual da página
        urllimpa = urlpg.split("?")[0]      //tira tudo o que estiver depois de '?'
        window.history.replaceState(null, null, urllimpa); //subtitui a url atual pela url limpa
    }
    setTimeout(limpaUrl, 0)
  </script> -->
    <script>
      function readURL(input) {
          var reader = new FileReader();
          reader.onload = function (e) {
          $('#inputImage').attr('src', e.target.result)
      };
      reader.readAsDataURL(input.files[0]);
      } 
      function mostraImagem(){
          $('input[type=file]').each(function(index){
              if ($('input[type=file]').eq(index).val() != ""){
                  readURL(this);
              }
          });
      }
    </script>
  </head>
  <body>
    <div class="grid-container">
    <div  class="grid-100" style="text-align: center;">

<div class="foco">
  <h1>  <a href="frmEditar.php"><img src="icons/seta2.png" width="3%"> </a> Selecione a foto de perfil ;D</h1>
  <form name="frmFoto" method="POST" action="foto.php" enctype="multipart/form-data" >

     <input type="reset" value="Limpar">
  <input type="submit" value="Enviar">

 <p><input type="file" name="foto" autofocus="autofocus" required="required" accept=".jpg, .jpeg" onchange="mostraImagem()"></p> <br>

<p><img id="inputImage" width="50%"></p>
  <input type="hidden" name="id" value="<?=$id?>">
</div>

  
</form>
  </body>
  </html>


  