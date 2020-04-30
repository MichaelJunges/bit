<?php

session_start();
	$PDO = new PDO("sqlite:./users.db");  //Diretório
	?>
<!DOCTYPE html>
<html>
<head>
	<title>■ NOVA CONTA ■</title>
	<link rel="stylesheet" href="css/unsemantic-grid-responsive.css">
	<link rel="stylesheet" href="css/login.css">
	 <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
	 <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
        function validarFormulario()	
        {	  
            if (document.frmCreate.login.value.trim().length < 4) 
            {
                alert("Insira login com 4 ou + caracteres");
                document.frmCreate.login.focus();
                return false;
            }
            return true;
        }
	</script>
	<script language="Javascript">
	  function validarEmail(){
		if( document.forms[0].email.value==""){
			document.getElementById("msgemail").innerHTML = "<font color='red'>Por favor digite um e-mail</font>";
			return false;
		}else if( document.forms[0].email.value.indexOf('@')==-1
		     || document.forms[0].email.value.indexOf('.')==-1 ){
			  document.getElementById("msgemail").innerHTML = "<font color='red'>E-mail Inválido</font>";
			  return false;
		}else{
			document.getElementById("msgemail").innerHTML = "";
			return true;
		}
	  }
		document.getElementById("email").addEventListener("input", function (event) {
		  if (validarEmail()) {
		    fetch('verifica.php?email=${this.value}')
		      .then(response => {
		        if (response.ok) {
		          return response.json();
		        }
		        throw new Error("Oops! Algo de errado não está certo...");
		      })
		      .then(json => {
		        if (json.exists) {
		          document.getElementById("msgemail").innerHTML = "<font color='red'>E-mail já está cadastrado. Por favor, tente outro.</font>";
		        } else {
		          document.getElementById("msgemail").innerHTML = "<font color='green'>E-mail disponível.</font>";
		          document.getElementById("enviar").disabled = false;
		        }
		      })
		      .catch(error => {
		        document.getElementById("msgemail").innerHTML = "<font color='red'>Falha no servidor, por favor, tente novamente mais tarde.</font>";
		      });
		  }
		});
	</script>
</head>

<body >
	<form name="frmCreate" action="create_u.php" method="post" onsubmit="return validarFormulario()">

	<div class="grid-container">
		<div style="padding-top: 1%" class="grid-100">

<div style="text-align: center;">
			<h1>REGISTRO</h1>
			<p> 
				<input type="text" size="30" id="login" name="login" required="required" maxlength="6" pattern="[a-zA-Z0-9-]+" placeholder="Login"><br>
				<span id="msglogin" style="margin: 0; color: red"></span>
				<script language="javascript">
				    var login = $("#login"); 
				        login.blur(function() { 
				            $.ajax({ 
				                url: 'verificaLogin.php', 
				                type: 'POST', 
				                data:{"login" : login.val()}, 
				                success: function(data) { 
				                console.log(data); 
				                data = $.parseJSON(data); 
				                $("#msglogin").text(data.login);
				            } 
				        }); 
				    }); 
				</script> 
			</p>
			<p> 
				<input type="text" size="30" name="nreal" required="required" maxlength="50" pattern="[a-zA-Z- ]+" placeholder="Nome Real"> 
			</p>
			<p> 
				<input type="email" size="30" name="email" id="email" maxlength="50" required="required" placeholder="Email" onblur="validarEmail()"><br>
				<span id="msgemail" style="margin: 0; color: red"></span>
				<script language="javascript">
				    var email = $("#email"); 
				        email.blur(function() { 
				            $.ajax({ 
				                url: 'verificaEmail.php', 
				                type: 'POST', 
				                data:{"email" : email.val()}, 
				                success: function(data) { 
				                console.log(data); 
				                data = $.parseJSON(data); 
				                $("#msgemail").text(data.email);
				            } 
				        }); 
				    }); 
				</script>
			</p>
			<p> 
				<input type="password" size="30" name="pass" required="required" pattern="[a-zA-Z0-9-]+" placeholder="Senha"> 
			</p>
			<p class="radio" >
				<input  type="radio" id="m" name="sexo" required="required" value="F">Feminino
                   <input type="radio" id="f" name="sexo" value="M"> Masculino
                   <input type="radio" id="b" name="sexo" value="B"> Não-Binário
			</p>
			<p>  
				<input type="submit"  value="REGISTRAR">
			</p>
			
			<p>  
				<a class="aviso" style="color: white; text-decoration: none;" href="index.php">
				Voltar Pagina</a>
			</p>
		</div>
	</div>
</div>
</form>


</body>
</html>