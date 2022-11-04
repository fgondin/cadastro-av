<?php

session_start();
//Inicia uma nova sessão ou resume uma sessão existente.
ob_start();
//Usando para limpar os cookies da sessão anterior.

require 'head.php';
require 'config.php';
//Chamando os arquivos PHP para serem redirecionados no futuro.

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if(!empty($dados['SendLogin'])){
//Impedindo que o usuário deixe alguma das áresas vazias. (errado)

    $sql = $pdo->prepare("SELECT * FROM tbl_admin WHERE email = :email");
    $sql->bindParam(':email', $dados['email'], PDO::PARAM_STR);
    //Insere especificamente um parametro.
    $sql->execute();

    if(($sql) && ($sql->rowCount() != 0)){

        $resultado = $sql->fetch(PDO::FETCH_ASSOC);
        //Buscando uma linha de resultados e transformando em uma array.

        if(password_verify($dados['password'], $resultado['senha'])){
        //Verifica se a senha digitada confere com a criptografia.

            $_SESSION['id'] = $resultado ['id'];
            $_SESSION['nome'] = $resultado ['nome'];
            header ('Location: index.php');
            exit;

        }else{
            $_SESSION['msg'] = "<p style='color: #ff0000'>ERRO: Usuário ou senha invalidos!</p>";
            //Caso algo esteja errado, irá aparecer uma mensagem em vermelho para o usuário.
        }

        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset ($_SESSION['msg']);
        }
        //Um código para destruir a mensagem após o término da sessão para não haver conflitos.

    }

}
?>

<div class="container">

    <h1>login<h1>

    <form action="" method="post">

        <div class="mb-3">
            <label for="" class="form-label">
                Email: <br>
                <input type="email"
                name="email"
                class="form-control"
                value="<?php if(isset($dados['email'])){echo $dados['email'];}?>"
                >
            </label>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">
                senha: <br>
                <input type="password" name="password" class="form-control">
            </label>
        </div>

        <input type="submit" value="Salvar" name="SendLogin" class="btn btn-primary"/>
    </form>
    <h5><a type="button" class="btn btn-link" href="formulario.php">Cadastrar</a></h5>
</div>

<?php include 'footer.php'; ?>