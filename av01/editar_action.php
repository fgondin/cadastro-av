<?php 

    require 'config.php';

    $id = filter_input(INPUT_POST, 'id');
    $nome = filter_input(INPUT_POST, 'nome');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $idade = filter_input(INPUT_POST, 'idade');
    $contato = filter_input(INPUT_POST, 'contato');
    $endereco = filter_input(INPUT_POST, 'endereco');

    if ($id && $name && $email && $idade && $contato && $endereco) {
        
        $sql = $pdo->prepare("UPDATE tbl_alunos SET nome =:nome, email = :email, idade = :idade, contato = :contato, endereco = :endereco WHERE id = :id");
        $sql->bindValue(":nome", $nome);
        $sql->bindParam(":email", $email);
        $sql->bindValue(":idade", $idade);
        $sql->bindValue(":contato", $contato);
        $sql->bindValue(":endereco", $endereco);
        $sql->execute ();

        header("Location:index.php");
        exit;

    } else {
        header('Location: editar.php');
        exit;
    } 

?>