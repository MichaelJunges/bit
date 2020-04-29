<?php
#Verifica se tem um email para pesquisa
if(isset($_POST['email'])){ 

    #Recebe o Email Postado
    $email = $_POST['email'];

    #Conecta banco de dados 
    $PDO = new PDO("sqlite:users.db");
    $sqlUser = $PDO->prepare("SELECT * FROM register WHERE email = ?");
    $sqlUser->execute(array($email));
    $dados = $sqlUser->fetchAll();

    #Se o retorno for maior do que zero, diz que já existe um.
    if($dados) 
        echo json_encode(array('email' => "Já existe um usuario cadastrado com este e-mail")); 
}
?>