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
    <link rel="stylesheet" href="css/style1.css?time=<?=time()?>">
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
                maxSize: [1024,1024],
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
        var idContador = 0;
        var resposta = 5;

        function  exclui(id ){
            var campo = $("#"+id.id).remove();
            idContador--;
            resposta = resposta -4;
        }
        $( document ).ready(function() {
            $("#btnAdicionarPergunta").click(function(e){
                e.preventDefault();
                var tipoCampo = "text";
                adicionaCampo(tipoCampo);
            })
            function adicionaCampo(tipo){

                idContador++;
                
                var idCampo = "pergunta"+idContador;
                var idForm = "formExtra"+idContador;
            
                var html = "";
                
                html += "<div style='margin-top: 8px;  ' id='"+idForm+"'>";
                html += "<p class='quiz'>Pergunta:</p>"
                html += "<input  type='text' size='50' name='pergunta"+idContador+"' required='required' maxlength='100'><br>";
                html += "<p class='quiz'>Resposta:</p>"
                html += "<input type='radio' name='certa"+idContador+"' required='required' value='1'><input  type='text' size='30' name='resposta"+resposta+"' required='required' maxlength='20'>"
                resposta++;
                html += "<p class='quiz'>Resposta:</p>"
                html += "<input type='radio' name='certa"+idContador+"' value='2'><input  type='text' size='30' name='resposta"+resposta+"' required='required' maxlength='20'><br>"
                resposta++;
                html += "<p class='quiz'>Resposta:</p>"
                html += "<input type='radio' name='certa"+idContador+"' value='2'><input  type='text' size='30' name='resposta"+resposta+"' required='required' maxlength='20'><br>"
                resposta++;
                html += "<p class='quiz'>Resposta:</p>"
                html += "<input type='radio' name='certa"+idContador+"' value='2'><input  type='text' size='30' name='resposta"+resposta+"' required='required' maxlength='20'><br>"
                resposta++;
                html += "<button onclick='exclui("+idForm+")' type='button' class='excluir'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbspExcluir Pergunta</button> "; 
                html += "</div>";
                
                
                $("#addPerg").append(html);
            }
        });

    </script>
</head>
<body>
    <form name="frmCreateQuiz" action="enviarQuiz.php" method="POST" enctype="multipart/form-data" >

     <div class="grid-container">
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
                <input  type="text" size="50" name="pergunta" required="required" maxlength="100">
            </p>    
            <p class="quiz">Selecione a resposta correta !</p>

            <p class="quiz"> 
                Resposta:<br /> 
                <input type="radio" name="certa" required="required" value="1"><input  type="text" size="30" name="resposta" required="required" maxlength="20">
            </p>    

            <p class="quiz"> 
                Resposta:<br /> 
                <input type="radio" name="certa" value="2"><input  type="text" size="30" name="resposta2" required="required" maxlength="20"> 
            </p>

            <p class="quiz"> 
                Resposta:<br /> 
                <input type="radio" name="certa" value="3"><input  type="text" size="30" name="resposta3" required="required" maxlength="20"> 
            </p>

            <p class="quiz"> 
                Resposta:<br /> 
                <input type="radio" name="certa" value="4"><input  type="text" size="30" name="resposta4" required="required" maxlength="20"> 
            </p>
            
            <div id="addPerg"></div>
            <p>
                <input type="button" class="adicionar" id="btnAdicionarPergunta" value="        Adicionar Pergunta">
            </p>
            <input type="hidden" name="id" value="<?=$id?>">
        <h1 style="color: white">Imagem grande ? Redimencione-a !</h1>
            <p>
                <img id="ImagemCrop" src="<?=$conteudo?>">
                <input type="hidden" id="x" name="x" />
                <input type="hidden" id="y" name="y" />
                <input type="hidden" id="w" name="w" />
                <input type="hidden" id="h" name="h" />
                <input type="hidden" id="imagem" name="imagem" value="<?=$conteudo?>" />
                <input type="hidden" name="foto" value="<?=$foto?>">
            </p>
                <p class="titulo">  
                    <h1 class="h1person">Quando você estiver pronto clique aqui</h1>
                    <input type="submit" value="FINALIZAR" id="finalizar">
                </p>
        </div>
    </div>  
    </form>
</body>
</html>