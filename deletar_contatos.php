<?php
require_once 'conectaBD.php';

session_start();

if (empty($_SESSION)) {
  // É necessário informar usuário e senha $_SESSION vazio
  header("Location: index.php?msgErro=Você precisa se autenticar no sistema.");
  die();
}

$result = array();

// Verificar se está chegando a informação (id_contatos) pelo $_GET
if (!empty($_GET['id_contatos'])) {

    // Buscar as informações do contato a ser alterado (no banco de dados)
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
      //Não foi encontrado nenhum registro
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
    <title>Apagar contao</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <script type ="text/javascript" src="js/jquery-3.6.1.min.js"></script>
    <script type ="text/javascript" src="js/bootstrap.min.js"></script>
  </head>
  <body style="padding-top: 10%;">
    <div class="col-6-custom">
      <div >
        <h1>Apagar contato da agenda</h1>
      </div>
      <div >
        <form action="contatos_model.php" method="post">
          <div class="col-12">
            <label for="id_contatos">ID</label>
            <input type="text" class="form-control" name="id_contatos" id="id_contatos" value="<?php echo $result['id']; ?>" readonly>
          </div>
          
          <div class="col-12">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" value="<?php echo $result['nome']; ?>" readonly>
          </div>

          <div class="col-12">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control" value="<?php echo $result['email']; ?>" readonly>
          </div>

          <div class="col-12">
            <label for="celular">Celular</label>
            <input type="text" name="celular" id="celular" class="form-control" value="<?php echo $result['celular']; ?>" readonly>
          </div>

          <br />

          <button type="submit" name="enviarDados" class="btn btn-primary" value="DEL" style="margin-right: 10px;">Apagar</button>
          <a href="index_logado.php" class="btn btn-danger">Cancelar</a>

        </form>
      </div>
    </div>
  </body>
</html>
