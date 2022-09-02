<?php
require_once 'conectaBD.php';

session_start();

if (empty($_SESSION)) {
  // É necessário informar usuário e senha $_SESSION vazio
  header("Location: index.php?msgErro=Você precisa se autenticar no sistema.");
  die();
}

$contatos = array();

if (!empty($_GET['meus_contatos']) && $_GET['meus_contatos'] == 1) {
  // Obter somente os contatos cadastrados pelo(a) usuário(a) logado(a).
  $sql = "SELECT * FROM contatos WHERE email_usuario = :email ORDER BY id ASC";
  $dados = array(':email' => $_SESSION['email']);

  try {
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute($dados)) {
      // Execução da SQL Ok!!
      $contatos = $stmt->fetchAll();
    }
    else {
      die("Falha ao executar a SQL.. #1");
    }
  } catch (PDOException $e) {
    die($e->getMessage());
  }
} else {
  $sql = "SELECT * FROM contatos ORDER BY id ASC";
  try {
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute()) {
      // Execução da SQL Ok!!
      $contatos = $stmt->fetchAll();

    }
    else {
      die("Falha ao executar a SQL.. #2");
    }

  } catch (PDOException $e) {
    die($e->getMessage());
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
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

    <div class="container" style="justify-content: center; display: flex; padding-top: 10%;">
        <h2 class="title">Olá <i><?php echo $_SESSION['nome']; ?></i>, seja bem-vindo(a)!</h2>
    </div>
    <div class="container"style="justify-content: center; display: flex; padding-top: 30px;">
      <a href="cadastrar_contatos.php" class="btn btn-primary" style="margin-right: 100px;">Novo contato</a>
      <a href="index_logado.php?meus_contatos=1" class="btn btn-success" style="margin-right: 100px;">Meus contatos</a>
      <a href="index_logado.php?meus_contatos=0" class="btn btn-info" style="margin-right: 100px;">Todos contatos</a>
      <a href="logout.php" class="btn btn-dark">Sair</a>
    </div>

    <?php if (!empty($contatos)) { ?>
      <div class="container"style="justify-content: center; display: flex; padding-top: 30px;">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Nome</th>
              <th scope="col">Email</th>
              <th scope="col">Celular</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($contatos as $a) { ?>
              <tr>
                <td><?php echo $a['nome']; ?></td>
                <td><?php echo $a['email']; ?></td>
                <td><?php echo $a['celular']; ?></td>
                <td>
                  <?php if ($a['email_usuario'] == $_SESSION['email']) { ?>
                    <a href="alterar_contatos.php?id_contatos=<?php echo $a['id']; ?>" class="btn btn-warning">Alterar</a>
                    <a href="deletar_contatos.php?id_contatos=<?php echo $a['id']; ?>" class="btn btn-danger">Excluir</a>
                  <?php } ?>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    <?php } ?>

  </body>
</html>
