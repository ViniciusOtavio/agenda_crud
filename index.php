<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Página Inicial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  </head>
  <body>
    <div class="container" style="align-content: center;">
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
    <div class="container" style="justify-content: center; display: flex;padding-top: 10%;">
    <h1>Seja bem-vindo(a) a agenda compartilhada.</h1>
    </div>
    <div class="container" style="justify-content: center; display: flex; padding-top: 30px;">
      <form action="login_model.php" method="post">
        <div class="col-12">
          <label for="email">E-mail</label>
          <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="col-12">
          <label for="senha">Senha</label>
          <input type="password" name="senha" id="senha" class="form-control">
        </div><br/>
        <button type="submit" name="enviarDados" class="btn btn-primary" style="margin-right: 100px; width: 110px;">Entrar</button>
        <a href="cadastrar_usuario.php" class="btn btn-success">Cadastrar-se</a>
      </form>
    </div>
  </body>
</html>
