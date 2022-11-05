<?php
session_start();
ob_start();
unset($_SESSION['id'], $_SESSION['nome']);
//Destrói a sessão anterior.

$_SESSION['msg'] = "<p style='color: green'>Deslogado com sucesso!</p>";
// Mensagem de avisa ao logout.

header("Location: login.php");
//Redireciona a página de login.
exit;