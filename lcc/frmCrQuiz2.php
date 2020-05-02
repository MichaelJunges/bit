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
        var alternativa = 3;
        var resultado = 1;

        function exclui(id ){
            var campo = $("#"+id.id).remove();
            idContador--;
            alternativa--;
        }
        function adicionaAlternativa(){

            idContador++;
                
            var alter = "alternativa"+alternativa;
            var idForm = "alter"+idContador;
            
            var html = "";
                
            html += "<div style='margin-top: 8px;' id='"+idForm+"'>";
            html += "<p class='quiz'>Alternativa:<br>"
            html += "<input  type='text' size='30' name='"+alter+"' required='required' maxlength='50'>"
            alternativa++;
            html += "<button onclick='exclui("+idForm+")' type='button' class='excluir'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button> "; 
            html += "</p></div>";
                
            $("#addAlter").append(html);
        }
        function adicionaResultado(){

            idContador++;
            resultado++;

            var idForm = "alter"+idContador;
            var resultado = "resultado"+resultado;

            var html = "";
                
            html += "<div style='margin-top: 8px;' id='"+idForm+"'>";
            html += "<p class='quiz'>Resultado:<br>"
            html += "<input  type='text' size='30' name='"+resultado+"' required='required' maxlength='50'>"
            resultado++;
            html += "<button onclick='exclui("+idForm+")' type='button' class='excluir'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button> "; 
            html += "</p></div>";
                
            $("#addResultado").append(html);
        }
        function adicionaCampo(){

                idContador++;
                
                var idCampo = "pergunta"+idContador;
                var idForm = "formExtra"+idContador;
                var alter = "alternativa"+alternativa;
            
                var html = "";
                
                html += "<div style='margin-top: 8px;' id='"+idForm+"'>";
                html += "<p class='quiz'>Pergunta:</p>"
                html += "<input  type='text' size='50' name='pergunta"+idContador+"' required='required' maxlength='100'><br>";
                html += "<p class='quiz'>Alternativa:</p>"
                html += "<input  type='text' size='30' name='"+alter+"' required='required' maxlength='50'>"
                alternativa++;
                html += "<p class='quiz'>Alternativa:</p>"
                html += "<input  type='text' size='30' name='"+alter+"' required='required' maxlength='50'><br><br>"
                alternativa++;
                html += "<input type='button' onclick='adicionaAlternativa()' class='adicionar' value='        Adicionar +Alternativa'><br><br>";
                html += "<button onclick='exclui("+idForm+")' type='button' class='excluir'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbspExcluir Pergunta</button><br><br>";
                html += "</div>";
                
                $("#addPerg").append(html);
        }
    </script>
</head>
<body>
    <div class="grid-container" style="text-align: center;">
    <form name="frmCreateQuiz2" action="enviarQuiz2.php" method="POST" enctype="multipart/form-data" >

         <h1 style="color: white"><a href="frmCreateQuiz2.php"><img src="icons/seta2.png" width="3%"> </a>Redimencione-a !</h1>

            <p >
                <img id="ImagemCrop" src="<?=$conteudo?>">
                <input type="hidden" id="x" name="x" />
                <input type="hidden" id="y" name="y" />
                <input type="hidden" id="w" name="w" />
                <input type="hidden" id="h" name="h" />
                <input type="hidden" id="imagem" name="imagem" value="<?=$conteudo?>" />
                <input type="hidden" name="foto" value="<?=$foto?>" >
            </p>

             <h1>Qual a categoria do seu Quiz ?</h1>  
             <p class="radio" >
                <input  type="radio" id="a" name="categoria" required="required"  value="ANIMES">Animes
                <input type="radio" id="b" name="categoria" value="BTS"> BTS
                <input type="radio" id="c" name="categoria" value="COMIDAS"> Comidas
                <input type="radio" id="d" name="categoria" value="YOUTUBERS"> Youtubers
                <input type="radio" id="f" name="categoria" value="FAMOSOS"> Famosos
                <input type="radio" id="g" name="categoria" value="GAMES"> Games
                <input type="radio" id="h" name="categoria" value="FUTEBOL"> Futebol
                <input type="radio" id="p" name="categoria" value="TV"> Programas de TV
                <input type="radio" id="t" name="categoria" value="FILMES/SÉRIES">Filmes e Seriados
                <input type="radio" id="m" name="categoria" value="MEMES">Memes
            </p> 


            <div class="grid-50"></div>
            <h1 style="padding-top: 0px" >Agora, preencha os campos !</h1>

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
           <!--  <h1 class="quiz">Selecione a alternativa correta !</h1> -->

            <p class="quiz"> 
                Alternativa:<br /> 
                <input  type="text" size="30" name="alternativa1" required="required" maxlength="50">
            </p>    

            <p class="quiz"> 
                Alternativa:<br /> 
                <input  type="text" size="30" name="alternativa2" required="required" maxlength="50"> 
            </p>
            <div id="addAlter"></div>
            <p> 
                <input type="button" class="adicionar" onclick="adicionaAlternativa()" value="        Adicionar +Alternativa">
            </p>

            <div id="addPerg"></div>
            <p> 
                <input type="button" class="adicionar" onclick="adicionaCampo()" value="        Adicionar +Pergunta">
            </p>
            <p>
                Resultado:<br>
                <input type="text" name="resultado1">
            </p>
            <div id="addResultado"></div>
            <p>
                <input type="button" class="adicionar" onclick="adicionaResultado()" value="        Adicionar +Resultado">

            </p>
            <input type="hidden" name="id" value="<?=$id?>">
       &nbsp
                
                    <input type="submit" value="FINALIZAR" id="finalizar">
        

                <p>  
               
            </p>
        </div>
    </div>  
    </form>


</body>
</html>