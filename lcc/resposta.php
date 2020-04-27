<body>
 
<?php
// acrescente as 3 linhas a seguir
$questao1 = $_POST['questao1'];
$questao2 = $_POST['questao2'];
$questao3 = $_POST['questao3'];
 
echo "Questao 1 = ".$questao1."<br>";
echo "Questao 2 = ".$questao2."<br>";
echo "Questao 3 = ".$questao3."<br>";
 
 
$resposta1 = "c";
$resposta2 = "d";
$resposta3 = "a";
 
 
$acertou = 0;
$errou = 0;
 
if ($questao1 == resposta1)
echo "Questao 1 correta<br>";
else echo "Questao 1 errada<br>";
 
if ($questao2 == resposta2)
echo "Questao 2 correta<br>";
else echo "Questao 2 errada<br>";
 
if ($questao3 == resposta3)
echo "Questao 3 correta<br>";
else echo "Questao 3 errada<br>";
 
 
?>
</body>