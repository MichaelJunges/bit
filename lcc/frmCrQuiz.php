<?php
session_start();

if($_SESSION["acesso"] != true) {
    $mensagem = urldecode("Erro");
    header("Location:index.php?msg=$mensagem");
    exit;
}
$PDO = new PDO("sqlite:users.db");
$id = $_SESSION["id"];

$local = $_FILES["foto"]["tmp_name"];
$foto = $_FILES['foto']["name"];
$conteudo = "fotos_quiz/$foto";
copy($local, $conteudo);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Criar Quiz</title>
    <!-- <link rel="stylesheet" href="css/.css?time=<?=time()?>"> -->
    <link rel="stylesheet" href="css/login.css?time=<?=time()?>">
    <link rel="stylesheet" href="css/unsemantic-grid-responsive.css">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/0.9.12/js/jquery.Jcrop.min.js"></script>
    <script language="Javascript"> 
        $(function(){ 
            $('#ImagemCrop').Jcrop({
                aspectRatio: 1,
                onSelect: UpdateCrop,
                setSelect: [0, 0, 200, 200],
                minSize: [200,200],
                maxSize: [2048,2048],
            });
        }); 
        function UpdateCrop(c)
        {
            $('#x').val(c.x);
            $('#y').val(c.y);
            $('#w').val(c.w);
            $('#h').val(c.h);
        };
    </script>
    <script>
        var idContador = 1;
        var resposta = 5;

        function  exclui(id ){
            var campo = $("#"+id.id).remove();
            idContador--;
            resposta = resposta - 4;
        }
        $( document ).ready(function() {
            $("#btnAdicionarPergunta").click(function(e){
                e.preventDefault();
                var tipoCampo = "text";
                adicionaCampo(tipoCampo);
            });
            function adicionaCampo(tipo){

                idContador++;
                
                var idCampo = "pergunta"+idContador;
                var idForm = "formExtra"+idContador;
            
                var html = "";
                
                html += "<div style='margin-top: 8px;' id='"+idForm+"'>";
                html += "<p class='quiz'>Pergunta:</p>"
                html += "<input  type='text' size='50' name='pergunta"+idContador+"' required='required' maxlength='100'><br>";
                html += "<p class='quiz'>Resposta:</p>"
                html += "<input type='radio' name='certa"+idContador+"' required='required' value='1'><input  type='text' size='30' name='resposta"+resposta+"' required='required' maxlength='50'>"
                resposta++;
                html += "<p class='quiz'>Resposta:</p>"
                html += "<input type='radio' name='certa"+idContador+"' value='2'><input  type='text' size='30' name='resposta"+resposta+"' required='required' maxlength='50'><br>"
                resposta++;
                html += "<p class='quiz'>Resposta:</p>"
                html += "<input type='radio' name='certa"+idContador+"' value='3'><input  type='text' size='30' name='resposta"+resposta+"' required='required' maxlength='50'><br>"
                resposta++;
                html += "<p class='quiz'>Resposta:</p>"
                html += "<input type='radio' name='certa"+idContador+"' value='4'><input  type='text' size='30' name='resposta"+resposta+"' required='required' maxlength='50'><br>"
                resposta++;
                html += "<button onclick='exclui("+idForm+")' type='button' class='excluir'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbspExcluir Pergunta</button> "; 
                html += "<input type='hidden' value='"+resposta+"' name='quantidadeResp'>";
                var contaPerg = idContador+1;
                html += "<input type='hidden' value='"+contaPerg+"' name='quantidadePerg'>";
                html += "</div>";
                
                $("#addPerg").append(html);
            }
        });
    </script>
</head>
<body>
    <div class="grid-container" style="text-align: center;">
    <form name="frmCreateQuiz" action="enviarQuiz.php" method="POST" enctype="multipart/form-data" >

         <h1 style="color: white">Imagem grande ? Redimencione-a !</h1>

            <p >
                <img id="ImagemCrop" src="<?=$conteudo?>">
                <input type="hidden" id="x" name="x" />
                <input type="hidden" id="y" name="y" />
                <input type="hidden" id="w" name="w" />
                <input type="hidden" id="h" name="h" />
                <input type="hidden" id="imagem" name="imagem" value="<?=$conteudo?>" />
                <input type="hidden" name="foto" value="<?=$foto?>" >
            </p>

     
        <div class="grid-100">
            <div class="grid-50"></div>
            <h1 class="h1person">Agora, preencha os campos !</h1>

            <p class="quiz"> 
                Titulo:<br /> 
                <input  type="text" size="50" name="titulo" required="required" maxlength="50" autofocus="autofocus" > 
            </p> 
            <p class="quiz"> 
                Pergunta: 

                <!-- name='pergunta"+idContador+"' -->
                <br /> 
                <input  type="text" size="50" name="pergunta1" required="required" maxlength="100">
            </p>    
           <!--  <h1 class="quiz">Selecione a resposta correta !</h1> -->

<p class="quiz"> 
                Resposta:<br /> 
                <input type="radio" name="certa1" required="required" value="1"><input  type="text" size="30" name="resposta1" required="required" maxlength="50">
            </p>    

            <p class="quiz"> 
                Resposta:<br /> 
                <input type="radio" name="certa1" value="2"><input  type="text" size="30" name="resposta2" required="required" maxlength="50"> 
            </p>

            <p class="quiz"> 
                Resposta:<br /> 
                <input type="radio" name="certa1" value="3"><input  type="text" size="30" name="resposta3" required="required" maxlength="50"> 
            </p>

            <p class="quiz"> 
                Resposta:<br /> 
                <input type="radio" name="certa1" value="4"><input  type="text" size="30" name="resposta4" required="required" maxlength="50"> 
            </p>
    

            <div id="addPerg"></div>
            <p> 
                <input type="button" class="adicionar" id="btnAdicionarPergunta" value="        Adicionar +Pergunta">
            </p>
            <input type="hidden" name="id" value="<?=$id?>">
       &nbsp
                <p class="titulo">  
                    <h1 class="h1person">Quando você estiver pronto clique aqui</h1>
                    <input type="submit" value="FINALIZAR" id="finalizar">
                </p>

                <p>  
                <a class="aviso" style="color: white; text-decoration: none;" href="index.php">
                Voltar Pagina</a>
            </p>
        </div>
    </div>  
    </form>


</body>
</html>