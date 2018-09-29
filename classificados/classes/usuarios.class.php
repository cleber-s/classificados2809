<?php
class Usuarios {

  public function cadastrar($nome, $email, $senha, $telefone) {
    global $pdo;
    //VERIFICA ANTES DO CADASTRO, SE O USUÁRIO EXISTE NO BANCO
    $sql = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email");
    $sql->bindValue(":email", $email);
    $sql->execute();

    //INSERE OS DADOS NO BANCO
    if($sql->rowCount() == 0) {
      $sql = $pdo->prepare("INSERT INTO usuarios SET nome = :nome, email = :email, senha = :senha, telefone = :telefone");
      $sql->bindValue(":nome", $nome);
      $sql->bindValue(":email", $email);
      $sql->bindValue(":senha", md5($senha));
      $sql->bindValue(":telefone", $telefone);
      $sql->execute();

      return true;

    } else {
        return false;
    }

  }

  public function login($email, $senha) {
    global $pdo;

    $sql = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email AND senha = :senha");
    $sql->bindValue(":email", $email);
    $sql->bindValue(":senha", md5($senha));
    $sql->execute();

    //VERIFICA SE HÁ UM USUÁRIO E SALVA OS DADOS DO USUÁRIO NA SESSÃO ATUAL
    if($sql->rowCount() > 0) {
      $dado = $sql->fetch();
      $_SESSION['cLogin'] = $dado['id'];
      return true;
    } else {
      return false;
    }

  }

  public function getName($id) {
    global $pdo;

    $sql = $pdo->prepare("SELECT nome FROM usuarios WHERE id = :id");
    $sql->bindValue(":id", $id);
    $sql->execute();

    if($sql->rowCount() > 0) {
      $dado = $sql->fetch();
      return $dado['nome'];
    }
  }
}
?>
