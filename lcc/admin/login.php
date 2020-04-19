<?php

session_start();

  $PDO = new PDO("sqlite:admin.db"); // Recua um diretório

  $login = $_POST["login"]; // coleta login form
  $pass =  $_POST["pass"]; // coleta senha form

  $sqlLogin = $PDO->prepare("SELECT * FROM info WHERE login='$login' AND pass ='$pass'");
  $sqlLogin->execute();
  $dados = $sqlLogin->fetchAll();
  

  if ($dados) {
    $_SESSION["acessoAdmin"] = true;
    $_SESSION["login"] = $dados[0]["login"];
    // $_SESSION["pass"] = $dados[0]["pass"];

    header("Location:home.php");
    
  }
  else
  {
    
    sleep(2);
    $mensagem = urldecode("Admin e/ou Senha inválidos");
    header("Location:index.php?msg=$mensagem");
  }
  ?>