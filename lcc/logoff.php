<?php
session_start();
if ($_SESSION["acesso"] != true) {

//Não está autenicado
$mensagem = urlencode("Você precisa logar");
header("Location:index.php?msg=$mensagem");
exit;
}
$mensagem = urlencode("Você Saiu");
session_destroy();
header("Location:index.php?msg=$mensagem");

?>