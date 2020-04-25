<?php
$PDO = new PDO("sqlite:../users.db");

$id  = $_GET["id"];
@$confirma = $_GET["confirma"];

if ( ($id) && ($confirma == 1) )
{
$sqlDelete = $PDO->prepare("DELETE FROM quiz WHERE id=?");
$del = $sqlDelete->execute(array($id));

header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
       <title>Remover Quiz</title>
       <link rel="stylesheet" href="../style1.css">
</head>
   
<body>
<script>
if (confirm("Deseja remover o quiz ?")) {
// ok
window.location.href = "excluirQ.php?id=<?=$id?>&confirma=1";
} else {
// cancelar
window.location.href = "home.php";
}
</script>
</body>
</html>