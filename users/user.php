<?php
 include "../conexao.php";

 session_start();

 if (!isset($_SESSION['email'])) {
    header("location: ..");
 }

 if (isset($_GET['sair'])) {
    session_destroy();
    header("location: ..");
 }

 if (isset($_GET['excluir'])) {
   $consulta=$conexao->prepare("DELETE FROM pessoa WHERE id=:id");
   $consulta->bindParam(':id',$_SESSION['id']);
   $consulta->execute();

   session_destroy();
   echo"<script>alert('Conta excluida com sucesso')</script>";
   echo"<script>window.location.href='..'</script>";
 }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="user.css"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
   <header> 
    <div class="div1">
    <?php echo"<h2>$_SESSION[nome]-$_SESSION[email]</h2>"?>
    </div>

     <div>
       <button class="btn1">
       <a href="user.php?sair=true">Sair da conta</a>
       </button>
       
       <button class="btn2">
       <a href="user.php?excluir">Excluir conta</a>
       </button>
       
     </div>

     <main>
       Bem vindo
     </main>
   </header>
</body>
</html>