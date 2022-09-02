<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Página Inicial</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <script type ="text/javascript" src="js/jquery-3.6.1.min.js"></script>
    <script type ="text/javascript" src="js/bootstrap.min.js"></script>
  </head>
  <body>
    <div >
      <?php if (!empty($_GET['msgErro'])) { ?>
        <div class="alert alert-warning" role="alert">
          <?php echo $_GET['msgErro']; ?>
        </div>
      <?php } ?>

      <?php if (!empty($_GET['msgSucesso'])) { ?>
        <div class="alert alert-success" role="alert">
          <?php echo $_GET['msgSucesso']; ?>
        </div>
      <?php } ?>
    </div>
    <div>
      <div class="col-6-custom" style="margin-top: 5%;">
      <img src="imagens/home.png" width="200" height="200">
      <h1 style="margin-top: 10%;">Seja bem-vindo(a) a agenda compartilhada.</h1>
        <form action="login_model.php" method="post">
          <div class="col-12">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" class="form-control">
          </div>
          <div class="col-12">
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" class="form-control">
          </div><br/>
          <button type="submit" name="enviarDados" class="btn btn-primary" style="margin-right: 10px; width: 110px;">Entrar</button>
          <a href="cadastrar_usuario.html" class="btn btn-success">Cadastrar-se</a>
        </form>
      </div>
    </div>
  </body>
</html>
