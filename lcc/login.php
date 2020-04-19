<?php

session_start();

  $PDO = new PDO("sqlite:users.db"); // Recua um diretório

  $login = $_POST["login"]; // coleta login form
  $pass = md5($_POST["pass"]); // coleta senha form

  $sqlLogin = $PDO->prepare("SELECT * FROM register WHERE login='$login' AND pass ='$pass'");
  $sqlLogin->execute();
  $dados = $sqlLogin->fetchAll();
  

  if ($dados) {
    $_SESSION["acesso"] = true;
    $_SESSION["email"] = $dados[0]["email"];
    $_SESSION["bio"] = $dados[0]["bio"];
    $_SESSION["id"] = $dados[0]["id"];
    $_SESSION["nreal"] = $dados[0]["nreal"];
    $_SESSION['login'] = $login;
    header("Location:home.php");
    
  }
  else
  {
    
    sleep(2);
    $mensagem = urldecode("Usuário e/ou Senha inválidos");
    header("Location:index.php?msg=$mensagem");

  }

 
  //var_dump($dadosUsuarios);
  //var_dump($login);
  //var_dump($senha);

  ?>