<?php 

require 'config.php';

$nome = filter_input (INPUT_POST, 'nome'); 
$email = filter_input (INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$idade = filter_input (INPUT_POST, 'idade'); 
$contato = filter_input (INPUT_POST, 'contato'); 
$endereco = filter_input (INPUT_POST, 'endereco'); 

if ($nome && $email && $idade && $contato && $endereco) {
    $sql = $pdo -> prepare ( "INSERT INTO alunos (nome, email, idade, contato, endereco)  VALUES  (:nome, :email, :idade, :contato, :endereco)" );
    $sql -> bindValue (':nome', $nome);
    $sql -> bindParam (':email', $email);
    $sql -> bindValue (':idade', $idade);
    $sql -> bindValue (':contato', $contato);
    $sql -> bindValue (':endereco', $endereco);
    $sql -> execute ();
    
    header("Location: index.php");
    
} else {
header ("Location: adicionar.php ");
    exit;
}