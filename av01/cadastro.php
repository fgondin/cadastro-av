<?php

require 'config.php';

$nome = filter_input (INPUT_POST, 'nome');
$email = filter_input (INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
//Esse em especifico valida se o email digitado é válido.
$senha = filter_input (INPUT_POST, 'senha');
$confirmarSenha = filter_input (INPUT_POST, 'confirmarSenha');
//filter_input tem como os atributos (O que será feito com a informação (nesse caso a postagem para o banco de dados)/nome da variável escrita em string).

if ($nome && $email && $senha && $confirmarSenha){
    $sql = $pdo->prepare("SELECT * FROM tbl_alunos WHERE email = :email");
    //O e-mail é resgatado do banco de dados e comparado ao e-mail digitado.
    //NUNCA MAIS FAZ UMA TABELA COM ESSE NOME, ANIMAL!
    $sql->bindValue (":email", $email);
    //Insere a informação do PHP para o SQL (coluna SQL/variável).
    $sql->execute();
    
    if ($sql->rowCount() === 0){
        //Exige que o e-mail seja usado apenas uma vez.
        
        if ($senha === $confirmarSenha) {
            $senha_hash = password_hash ($senha, PASSWORD_DEFAULT);
            //Criptografia da senha.

            $sql = $pdo->prepare("INSERT INTO tbl_alunos (nome, senha, email) VALUES (:nome, :senha, :email)");
            //Começando a inserção das variáveis em seus respectivos lugares na tabela.
            $sql->bindValue (":nome", $nome);
            $sql->bindValue (":senha", $senha_hash);
            $sql->bindValue (":email", $email);
            $sql->execute();
            header ("Location: home.php");
            //Se todos os "if" forem atendidos, o usuário é levado a página "home.php"
            exit;
        }else{
            header ("Location: formulario.php");
            exit;
        };
    }else{
        header ("Location: formulario.php");
        exit;
    };
}else{
    header ("Location: formulario.php");
    exit;
};
//Else sendo usados para caso um dos testes estiverem errados, voltar a tela de formulário.