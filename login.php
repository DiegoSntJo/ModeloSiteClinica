<?php
     require_once 'CLASSES/usuarios.php';
     $u = new Usuario;
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> BemEstar - Cuidando do seu bem estar ! </title>
    <meta name="author" content="Diego Santos">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="icon" href="img/icon.png">
  </head>

  <body>
    <!-- CABEÇALHO --> 
    <header class="cabecalho container">
      <a href="index.php"><h1 class="logo"> BemEstar - Cuidando do seu bem estar ! </h1></a>
      <button class="btn-menu bg-gradient"><i class="fa fa-bars fa-lg"></i></button>
      <nav class="menu">
        <a class="btn-close"><i class="fa fa-times"></i></a>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="index.php#us">Quem somos</a></li>
          <li><a href="index.php#contato">Contato</a></li>
          <li><a href="login.php">Login</a></li>
        </ul>
      </nav>          
    </header>

    <!-- LOGIN --> 
    <section class="login container">
      <div class="corpo-form" id="corpo-form">
        <h2>Entrar</h2>
        <p>(Entre para agendar consultas, pesquisar agendamentos e conferir nossos planos parceiros.)</p>
        <form class="form" method="POST">
          <input type="email" name="email" placeholder="Usuário" maxlength="40" autocomplete="off" required><br>
          <input type="password" name="senha" placeholder="Senha" maxlength="15"><br>
          <input type="submit" value="ACESSAR">
        </form>
      </div>
      <div class="avis">
        <p>Caso não tenha cadastro ainda, <a href="cadastrar.php">clique aqui !</a></p>
      </div>
    

      <?php
        if(isset($_POST['email'])){
          $email = addslashes($_POST['email']);
          $senha = addslashes($_POST['senha']);
          //verificar se esta preenchido
          if(!empty($email) && !empty($senha)){
          $u->conectar();
            if($u->msgErro == ""){
              if($u->logar($email,$senha)){
                header("location: Agendamento/menu.php");
              }
              else{
                ?>
                  <div class="msg-erro"> Email e/ou senha estão incorretos!</div>
                <?php
              }
            }
            else{
              ?>
              <div class="msg-erro"><?php echo "Erro: " . $u->msgErro; ?></div>
              <?php
            }
          }
          else{
            ?>
              <div class="msg-erro">Preencha todos os campos !</div>
            <?php
          }
        }
      ?>
<br><br><br><br><br><br><br><br><br>
<div></div>
    </section>

    <!-- NEWSLETTER -->
    <section class="newsletter container bg-black">
      <h2> Inscreva-se agora! </h2>
      <h3>  Receba novidades, dicas e muito mais </h3>
      <form>
        <input class="bg-black radius" type="email" name="email" placeholder="Seu email">
        <button class="bg-white radius"> Cadastrar </button>
      </form>
    </section>

    <!-- RODAPÉ -->
    <footer class="rodape container bg-gradient">
      <div class="social-icons">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-google"></i></a>
        <a href="#"><i class="fa fa-instagram"></i></a>
        <a href="#"><i class="fa fa-envelope"></i></a>
      </div>

      <p class="copyright">Copyright © 2021. Todos os direitos reservados.</p>
    </footer>       
        
    <!-- JQUERY --> 
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script>
      $(".btn-menu").click(function(){
        $(".menu").show();
      });

      $(".btn-close").click(function(){
        $(".menu").hide();
      });
    </script>      
  </body>
</html>