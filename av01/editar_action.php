<?php
    require 'config.php';

    $id = filter_input(INPUT_POST, 'id');
    $nome = filter_input(INPUT_POST, 'nome');
    $email = filter_input(INPUT_POST, 'email');
    $idade = filter_input(INPUT_POST, 'idade');
    $contato = filter_input(INPUT_POST, 'contato');
    $endereco = filter_input(INPUT_POST, 'endereco');
    //Filtra os novos valores os colocando nas variáveis.

    if($id && $nome && $email && $idade && $contato && $endereco) { 

        $sql = $pdo->prepare( "UPDATE tbl_aluno SET nome =:nome, email = :email, idade = :idade, contato = :contato, endereco = :endereco WHERE id = :id" ); // UPDATE alunos SET nome = 'Airtao' WHERE alunos.id = 4;
        $sql->bindValue(':id', $id);
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':idade', $idade);
        $sql->bindValue(':contato', $contato);
        $sql->bindValue(':endereco', $endereco);
        $sql->execute();
        //Comandos que atualizam o banco de dados com os novos dados.

        header("Location: index.php");
        exit;
        //Caso tudo dê certo, irá tetornar a página de origem.
    } else {
        header("Location: editar.php");
        exit;
        //Caso dê errado, volta a edição normal.
    }

?>