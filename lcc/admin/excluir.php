<?php
$PDO = new PDO("sqlite:../users.db");

$id  = $_GET["id"];
@$confirma = $_GET["confirma"];

if ( ($id) && ($confirma == 1) )
{
$sqlDelete = $PDO->prepare("DELETE FROM register WHERE id=?");
$del = $sqlDelete->execute(array($id));
unlink("../fotos/$id.jpg");

header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
       <title>Remover Usuario</title>
       <link rel="stylesheet" href="../style1.css">
</head>
   
<body>
<script>
if (confirm("Deseja remover o Usuario?")) {
// ok
window.location.href = "excluir.php?id=<?=$id?>&confirma=1";
} else {
// cancelar
window.location.href = "home.php";
}
</script>
</body>
</html>