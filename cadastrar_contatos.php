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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  </head>
  <body style="padding-top: 10%;">
    <div class="container">
      <div style="justify-content: center; display: flex; padding-top: 30px;">
        <h1>Cadastrar Novo Contato na Agenda</h1>
      </div>
      <div class="container"style="justify-content: center; display: flex; padding-top: 30px;">
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

        <button type="submit" name="enviarDados" class="btn btn-primary" value="CAD" style="margin-right: 100px;">Cadastrar</button>
        <a href="index_logado.php" class="btn btn-danger">Cancelar</a>

        </form>
      </div>
      
    </div>
  </body>
</html>
