<?php
require('conecxaoBD.php');

if (isset($_POST['nome']) || isset($_POST['email']) || isset($_POST['senha'])) {
    if (strlen($_POST['nome']) == 0) {
        echo "preencha seu nome";
    } else if (strlen($_POST['email']) == 0) {
        echo "preencha seu email";
    } else if (strlen($_POST['senha']) == 0) {
        echo "preencha seu senha";
    } else {

        $email = $_POST['email'];

        $stmt = $database->query("SELECT * FROM usuario WHERE email = '$email'");

        $usuario = $stmt->fetch();

        if (!$usuario) {
            $stmt = $database->prepare('INSERT INTO usuario (nome, email, senha) VALUES(:nome, :email, :senha)');
            $stmt->execute(array(
                ':nome' => $_POST['nome'],
                ':email' => $_POST['email'],
                ':senha' => $_POST['senha']
            ));

            $stmt = $database->query("SELECT * FROM usuario WHERE email = '$email'");

            $usuario = $stmt->fetch();

            if (!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header('Location: index.php');
        } else {
            echo "Email já cadsatrado";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Site Critica</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <main>
        <div class="container">
            <h2 align="center">Cadastro de Usuário</h2>
            <div class="col-md-4" style="margin:0 auto; float:none;">
                <form class="form_ec " action="" method="post">
                    <div class="form-group">
                        <label for="nome">Nome: </label>
                        <input type="text" name="nome" placeholder="insira o título" class="form-control"/>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input type="email" name="email" placeholder="insira o título" class="form-control"/>
                    </div>
                    
                    <div class="form-group">
                        <label for="senha">senha: </label>
                        <input type="password" name="senha" placeholder="insira o título" class="form-control"/>
                    </div>

                    <div class="form-group" align="center">
                        <button type="submit" class="btn btn-info">Cadastrar</button>
                    </div>

                    <div class="form-group" align="center">
                        <a href="entrar.php">Já possuo uma conta</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

</html>