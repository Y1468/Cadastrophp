<?php
  include "../conexao.php";
  
  try {
    session_start();

  if (isset($_POST['email'],$_POST['senha'])) {

    $consulta=$conexao->prepare("SELECT*FROM pessoa WHERE email=:email AND senha=:senha");

      $consulta->bindParam(':email',$_POST['email']);
      $consulta->bindParam('senha',sha1($_POST['senha']));
      $consulta->execute();

      $resultado=$consulta->fetch();
      if (isset($resultado['email'])) {
      $_SESSION['nome']=$resultado['nome'];
      $_SESSION['email']=$resultado['email'];
      $_SESSION['id']=$resultado['id'];

      header("location: ../users/user.php");
    }else {
      echo"<script>alert('Usuario ou senha invalidos')</script>";
    }

  }

  } catch (\Throwable $th) {
    echo'<script>alert("Erro: '.$th->getMessage().'")/script>';
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="../Image/Adidas-Logo.png"/>
    <link rel="stylesheet" type="text/css" href="../Estilo/style.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<img src="../Image/Adidas-Logo.png"/>
   <div>
   <h1>Entre com sua conta</h1>
    <form action="login.php" method="POST">
      <div>
        <input type="email" name="email" placeholder="Digite sêu e-mail" autofocus/><br/>
        <input type="password" name="senha" placeholder="Didite sua senha"/><br/>
      </div>

      <div class="btn">
        <button type="submit">
           Acessar
        </button>
      </div>
    </form>

     <div class="link">
       <a href="../index.php">Não possui uma conta? cadastre-se</a>
     </div>
</div>
   
</body>
</html>