<?php
require 'config.php';

if(empty($_SESSION['cLogin'])) { //CASO O USUARIO NAO ESTEJA LOGADO, VAI PARA A TELA DE LOGIN
  header("Location: login.php");
  exit;
}

require 'classes/anuncios.class.php';
$a = new Anuncios();

if(isset($_GET['id']) && !empty($_GET['id'])) {
  $a->excluirAnuncio($_GET['id']);

}

header("Location: meus-anuncios.php");
?>
