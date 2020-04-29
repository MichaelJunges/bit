<?php
#Verifica se tem um login para pesquisa
if(isset($_POST['login'])){ 

    #Recebe o Email Postado
    $login = $_POST['login'];

    #Conecta banco de dados 
    $PDO = new PDO("sqlite:users.db");
    $sqlUser = $PDO->prepare("SELECT * FROM register WHERE login = ?");
    $sqlUser->execute(array($login));
    $dados = $sqlUser->fetchAll();

    #Se o retorno for maior do que zero, diz que já existe um.
    if($dados) 
        echo json_encode(array('login' => "Já existe um usuario cadastrado com este login"));
    else
        echo json_encode(array('login' => ""));
}
?>