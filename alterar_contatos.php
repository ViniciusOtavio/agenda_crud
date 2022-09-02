<?php
require_once 'conectaBD.php';

session_start();

if (empty($_SESSION)) {
  // É necessário informar usuário e senha $_SESSION vazio
  header("Location: index.php?msgErro=Você precisa se autenticar no sistema.");
  die();
}

$result = array();

// Verificar se está chegando o (id_contatos)
if (!empty($_GET['id_contatos'])) {

    // Buscar as informações do contato a ser alterado utilizando o email_usuario como fk
  $sql = "SELECT * FROM contatos WHERE email_usuario = :email AND id = :id";
  try {
    $stmt = $pdo->prepare($sql);

    $stmt->execute(array(':email' => $_SESSION['email'], ':id' => $_GET['id_contatos']));

    // Verificar se o usuário logado pode acessar/alterar as informações desse registro (id_contatos)
    if ($stmt->rowCount() == 1) {
      // Registro obtido no banco de dados
      $result = $stmt->fetchAll();
      $result = $result[0]; // Informações do registro a ser alterado

    }
    else {
      // Não foi encontrado nenhum registro
      header("Location: index_logado.php?msgErro=Você não tem permissão para acessar esta página");
      die();
    }

  } catch (PDOException $e) {
    header("Location: index_logado.php?msgErro=Falha ao obter registro no banco de dados.");

  }
}
else {
  // Se entrar aqui, significa que $_GET['id_contatos'] está vazio
  header("Location: index_logado.php?msgErro=Você não tem permissão para acessar esta página");
  die();
}

?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Alterar contato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  </head>
  <body style="padding-top: 10%;">
    <div class="container">
      <div style="justify-content: center; display: flex; padding-top: 30px;">
        <h1>Alterar contato</h1>
      </div>
      <div class="container"style="justify-content: center; display: flex; padding-top: 30px;">
        <form action="contatos_model.php" method="post">
          <div class="col-12">
            <label for="id_contatos">ID</label>
            <input type="text" class="form-control" name="id_contatos" id="id_contatos" value="<?php echo $result['id']; ?>" readonly>
          </div>

          <div class="col-12">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" value="<?php echo $result['nome']; ?>">
          </div>

          <div class="col-12">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control" value="<?php echo $result['email']; ?>">
          </div>

          <div class="col-12">
            <label for="celular">Celular</label>
            <input type="celular" name="celular" id="celular" class="form-control" value="<?php echo $result['celular']; ?>">
          </div>

          <br />

          <button type="submit" name="enviarDados" class="btn btn-primary" value="ALT" style="margin-right: 100px;">Alterar</button>
          <a href="index_logado.php" class="btn btn-danger">Cancelar</a>

        </form>
      </div>
    </div>
  </body>
</html>
