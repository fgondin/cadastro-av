<?php 
    require 'config.php';
    include 'head.php';

    $lista = [];

    $sql = $pdo->query("SELECT * FROM tbl_aluno");

    if($sql->rowCount() > 0) {
        $lista = $sql->fetchall(PDO::FETCH_ASSOC);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <title>Editar Usuário</title>
</head>
<body>
    
    <h1> Editar usuário </h1>

    <form method="post" action="editar_action.php">

        <label for="">
            Nome: <br/>
            <input type="text" name="nome">
            <br>
        </label> <br/>

        <label for="">
            E-mail: <br/>
            <input type="email" name="email">
            <br>
        </label> <br/>

        <label for="">
            Idade: <br/>
            <input type="idade" name="idade">
        </label> <br/>

        <label for="">
            Contato: <br/>
            <input type="contato" name="contato">
        </label> <br/>

        <label for="">
            Endereço: <br>
            <input type="endereco" name="endereco">
        </label>

        <input type="submit" value="Salvar" class="btn btn-primary">
    </form>

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
                    </tr>
                <?php endforeach; ?>
            </table>
    
        </div>

</body>
</html>