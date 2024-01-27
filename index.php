
<?php
 include "conexao.php";

 try {
  session_start();

  if (isset($_SESSION['email'])) {
    header("location: ./users/user.php");
  }
 
  if (isset($_POST['nome'],$_POST['email'],$_POST['senha'])) {
     
   $consulta=$conexao->prepare("INSERT INTO pessoa(nome,email,senha) VALUES (:nome,:email,:senha)");
     $consulta->bindParam(':nome',$_POST['nome']);
     $consulta->bindParam(':email',$_POST['email']);
     $consulta->bindParam(':senha',sha1($_POST['senha']));
     $consulta->execute();
 
     $_SESSION['nome']=$_POST['nome'];
     $_SESSION['email']=$_POST['email'];
     $_SESSION['id']=$conexao->lastInsertId();
 
     header("location: ./users/user.php");
   }

 } catch (\Throwable $th) {

   if ($th->getCode()==23000) {
    echo'<script>alert("Erro: O e-mail\" ' .$_POST['email'].' \" ja esta cadastrado")</script>';
   }else{
     echo'<script>alert("Erro '.$th->getMessage().'")</script>';
   }
 }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="./Image/Adidas-Logo.png"/>
    <link rel="stylesheet" type="text/css" href="./Estilo/style.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de usuario</title>
</head>
<body>
  <img src="./Image/Adidas-Logo.png"/>
    <div>
    <h1>Cadastre-se</h1>
        <form action="index.php" method="POST">
           <input type="text" name="nome" placeholder="Digite sêu nome" autofocus/><br/>
           <input type="email" name="email" placeholder="Digite sêu e-mail"/><br/>
           <input type="password" name="senha" placeholder="Didite sua senha"/><br/>

           <div class="btn">
             <button type="submit">
              Cadastrar
             </button>
            
           </div>
        </form>
        <div class="link">
        <a href="./Login/login.php">Possui uma conta? faça login</a>
        </div>
    </div>
</body>
</html>