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
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <section class="section_form">
            <form class="form_ec " action="" method="post">
                
                <img src="img/pipoca.png" alt="logo">

                <label for="email">Email: </label>
                <input type="email" name="email">

                <label for="senha">senha: </label>
                <input type="password" name="senha">

                <button type="submit">Entrar</button>

                <a href="cadastro.php">Cadastrar-se</a>
            </form>
        </section>
    </main>
</body>

</html>