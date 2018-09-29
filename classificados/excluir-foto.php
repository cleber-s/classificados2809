<?php
require 'config.php';

if(empty($_SESSION['cLogin'])) { //CASO O USUARIO NAO ESTEJA LOGADO, VAI PARA A TELA DE LOGIN
  header("Location: login.php");
  exit;
}

require 'classes/anuncios.class.php';
$a = new Anuncios();

if(isset($_GET['id']) && !empty($_GET['id'])) {
  $id_anuncio = $a->excluirFoto($_GET['id']); //AO EXCLUIR A FOTO ELE RETORNA O ID DO ANUNCIO
}

if(isset($id_anuncio)) {
  header("Location: editar-anuncio.php?id=".$id_anuncio);
} else {
  header("Location: meus-anuncios.php");
}

header("Location: meus-anuncios.php");
?>
