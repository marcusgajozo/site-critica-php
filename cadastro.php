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
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <section class="section_form">
            <form class="form_ec " action="" method="post">
                <img src="img/pipoca.png" alt="logo">
                <label for="nome">Nome: </label>
                <input type="text" name="nome">

                <label for="email">Email: </label>
                <input type="email" name="email">


                <label for="senha">senha: </label>
                <input type="password" name="senha">


                <button type="submit">Cadastrar</button>
                <a href="entrar.php">Já possuo uma conta</a>
            </form>
        </section>
    </main>
</body>

</html>