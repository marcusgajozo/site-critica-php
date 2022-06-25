<?php
require('conecxaoBD.php');

if (isset($_POST['email']) || isset($_POST['senha'])) {
    if (strlen($_POST['email']) == 0) {
        echo "preencha seu email";
    } else if (strlen($_POST['senha']) == 0) {
        echo "preencha sua senha";
    } else {

        $email = $_POST['email'];
        $senha = $_POST['senha'];


        $stmt = $database->query("SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'");

        $usuario = $stmt->fetch();

        if ($usuario) {


            if (!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: index.php");
        } else {
            echo "Falha ao logar! Email ou senha inválido...";
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
    <title>Login - Site Critica</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="style.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <header>
        <div class="menu">
            <div id="logo">
                <a href="index.php"><img src="img/pipoca.png" alt="Logo"></a>
            </div>
            <nav>
                <a href="index.php">Voltar</a>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <h2 align="center">Login</h2>
            <div class="col-md-4" style="margin:0 auto; float:none;">
                <form class="form_ec " action="" method="post">
                    <div class="form-group">    
                        <label for="email">Email: </label>
                        <input type="email" name="email" placeholder="insira o email" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label for="senha">Senha: </label>
                        <input type="password" name="senha" placeholder="insira a senha" class="form-control"/>
                    </div>
                    
                    <div class="form-group" align="center">
                        <button type="submit" class="btn btn-info">Entrar</button>
                    </div>
                    
                    <div class="form-group" align="center">
                        <a href="cadastro.php">Cadastrar-se</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

</html>