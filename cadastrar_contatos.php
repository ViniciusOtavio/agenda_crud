<?php
session_start();

if (empty($_SESSION)) {
  // É necessário informar usuário e senha $_SESSION vazio
  header("Location: index.php?msgErro=Você precisa se autenticar no sistema.");
  die();
}

?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Cadastrar Novo Contato</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <script type ="text/javascript" src="js/jquery-3.6.1.min.js"></script>
    <script type ="text/javascript" src="js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="col-6-custom" style="margin-top: 10%;">
        <h1>Cadastrar Novo Contato na Agenda</h1>
        <form action="contatos_model.php" method="post">

        <div class="col-12">
          <label for="nome">Nome</label>
          <input type="text" name="nome" id="nome" class="form-control">
        </div>

        <div class="col-12">
          <label for="email">Email</label>
          <input type="text" name="email" id="email" class="form-control">
        </div>

        <div class="col-12">
          <label for="celular">Celular</label>
          <input type="text" name="celular" id="celular" class="form-control">
        </div>

        <br />

        <button type="submit" name="enviarDados" class="btn btn-primary" value="CAD" style="margin-right: 10px;">Cadastrar</button>
        <a href="index_logado.php" class="btn btn-danger">Cancelar</a>

        </form>
    </div>
  </body>
</html>
