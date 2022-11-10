<?php
session_start();

ob_start();

if((!isset($_SESSION['id'])) && (!isset($_SESSION['nome']))){
    $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Necessário fazer o login!</p>";
    header("Location: index.php");
}

?>

<?php

    require 'config.php';
    include 'head.php';

    $lista = [];

    $sql = $pdo->query("SELECT * FROM tbl_aluno");

    if($sql->rowCount() > 0) {
        $lista = $sql->fetchall(PDO::FETCH_ASSOC);
    }

    $id = filter_input(INPUT_GET, 'aluno_id');
    $nome = filter_input(INPUT_GET, 'nome');
    $email = filter_input(INPUT_GET, 'email');
    $idade = filter_input(INPUT_GET, 'idade');
    $contato = filter_input(INPUT_GET, 'contato');
    $endereco = filter_input(INPUT_GET, 'endereco');

    $lista = $pdo->query("SELECT * FROM tbl_pesquisa WHERE nome LIKE'%$nome%' and email LIKE'%$email%' and idade LIKE'%$idade%' and contato LIKE'%$contato%' and endereco LIKE'%$endereco%'");

?>


<body>

    <div class="container">
        
        
        <div>
            <a class="btn btn-primary" href="adicionar.php"> Adicionar usuário </a>
        </div>

        <div class="d-flex">

            <form action="" method="get">
                <input type="search" name="id" id="" placeholder="Buscar por id...">
                <input type="search" name="nome" id="" placeholder="Buscar por nome...">
                <input type="search" name="email" id="" placeholder="Buscar por email...">
                <input type="search" name="idade" id="" placeholder="Buscar por idade...">
                <input type="search" name="contato" id="" placeholder="Buscar por contato...">
                <input type="search" name="endereco" id="" placeholder="Buscar por endereço...">
                <input class="btn btn-primary" type="submit" value="Buscar">
            </form>

        </div>

        <div>
            <a href="./logout.php">Sair</a>
        </div>
        
        <div>
    
            <table class="table">
            
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Idade</th>
                    <th>Contato</th>
                    <th>Endereço</th>
    
                </tr>
                <?php foreach($lista as $usuario): ?>
                    <tr>
                        <td> <?php echo $usuario['aluno_id']; ?> </td>
                        <td> <?= $usuario['nome']; ?> </td>
                        <td> <?= $usuario['email']; ?> </td>
                        <td> <?= $usuario['idade']; ?> </td>
                        <td> <?= $usuario['contato']; ?> </td>
                        <td> <?= $usuario['endereco']; ?> </td>
                        <td>
                            <a href="editar.php?id=<?=$usuario['aluno_id']; ?>" 
                                class="btn btn-success"
                            >
                                editar
                            </a>
                            <a 
                            href="excluir.php?id=<?=$usuario['id']; ?>"
                            onclick="return confirm('Tem certeza que deseja excluir ?')"
                            class="btn btn-danger"
                            >
                            excluir
                            </a>


                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
    
        </div>

    </div>    


</body>
</html>