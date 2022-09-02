<?php
require_once 'conectaBD.php';
// Definir o BD (e a tabela)
// Conectar ao BD (com o PHP)

session_start();

if (empty($_SESSION)) {
  // É necessário informar usuário e senha $_SESSION vazio
  header("Location: index.php?msgErro=Você precisa se autenticar no sistema.");
  die();
}

if (!empty($_POST)) {
  // Está chegando dados por POST e então posso tentar inserir no banco
  // Obter as informações do formulário ($_POST)
  // Verificar se estou tentando INSERIR (CAD) / ALTERAR (ALT) / EXCLUIR (DEL)
  if ($_POST['enviarDados'] == 'CAD') { // CADASTRAR!!!
    try {
      // Preparar as informações
        // Montar a SQL (pgsql)
        $sql = "INSERT INTO contatos
                  (nome, email, celular, email_usuario)
                VALUES
                  (:nome, :email, :celular, :email_usuario)";

        // Preparar a SQL (pdo)
        $stmt = $pdo->prepare($sql);

        // Definir/organizar os dados p/ SQL
        $dados = array(
          ':nome' => $_POST['nome'],
          ':email' => $_POST['email'],
          ':celular' => $_POST['celular'],
          ':email_usuario' => $_SESSION['email']
        );

        // Tentar Executar a SQL (INSERT)
        // Realizar a inserção das informações no BD (com o PHP)
        if ($stmt->execute($dados)) {
          header("Location: index_logado.php?msgSucesso=Anúncio cadastrado com sucesso!");
        }
    } catch (PDOException $e) {
        die($e->getMessage());
        header("Location: index_logado.php?msgErro=Falha ao cadastrar anúncio..");
    }
  }
  elseif ($_POST['enviarDados'] == 'ALT') { // ALTERAR!!!
    /* Implementação do update aqui.. */
    // Construir SQL para update
    try {
      $sql = "UPDATE
                contatos
              SET
                nome = :nome,
                email = :email,
                celular = :celular
              WHERE
                id = :id_contatos ";

      // Definir dados para SQL
      $dados = array(
        ':id_contatos' => $_POST['id_contatos'],
        ':nome' => $_POST['nome'],
        ':email' => $_POST['email'],
        ':celular' => $_POST['celular']
      );

      $stmt = $pdo->prepare($sql);

      // Executar SQL
      if ($stmt->execute($dados)) {
        header("Location: index_logado.php?msgSucesso=Alteração realizada com sucesso!!");
      }
      else {
        header("Location: index_logado.php?msgErro=Falha ao ALTERAR anúncio..");
      }
    } catch (PDOException $e) {
      header("Location: index_logado.php?msgErro=Falha ao ALTERAR anúncio..");
    }

  }
  elseif ($_POST['enviarDados'] == 'DEL') { // EXCLUIR!!!
    /** Implementação do excluir aqui.. */
    // id_contatos ok
    // e-mail usuário logado ok
    try {
      $sql = "DELETE FROM contatos WHERE id = :id_contatos AND email_usuario = :email";
      $stmt = $pdo->prepare($sql);

      $dados = array(':id_contatos' => $_POST['id_contatos'], ':email' => $_SESSION['email']);

      if ($stmt->execute($dados)) {
        header("Location: index_logado.php?msgSucesso=Anúncio excluído com sucesso!!");
      }
      else {
        header("Location: index_logado.php?msgSucesso=Falha ao EXCLUIR anúncio..");
      }
    } catch (PDOException $e) {
      header("Location: index_logado.php?msgSucesso=Falha ao EXCLUIR anúncio..");
    }
  }
  else {
    header("Location: index_logado.php?msgErro=Erro de acesso (Operação não definida).");
  }
}
else {
  header("Location: index_logado.php?msgErro=Erro de acesso.");
}
die();

// Redirecionar para a página inicial com mensagem erro/sucesso
 ?>
