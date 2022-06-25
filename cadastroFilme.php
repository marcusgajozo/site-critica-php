<?php
require('conecxaoBD.php');

if (isset($_POST['titulo']) || isset($_POST['ano']) || isset($_POST['sinopse'])) {
    if (strlen($_POST['titulo']) == 0) {
        echo "preencha seu titulo";
    } else if (strlen($_POST['ano']) == 0) {
        echo "preencha o ano";
    } else if (strlen($_POST['sinopse']) == 0) {
        echo "preencha a sinopse";
    } else {

        $stmt = $database->prepare('INSERT INTO filme (titulo, ano, sinopse) VALUES(:titulo, :ano, :sinopse)');
        $stmt->execute(array(
            ':titulo' => $_POST['titulo'],
            ':ano' => $_POST['ano'],
            ':sinopse' => $_POST['sinopse']
        ));
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Filme - Site Critica</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <section>
            <h1>Cadastro de Filme</h1>
            <form action="" method="post">
                <p>
                    <label for="titulo">Titulo do Filme:</label>
                    <input type="text" name="titulo">
                </p>
                <p>
                    <label for="ano">Ano de Lançamento:</label>
                    <input type="text" name="ano">
                </p>
                <p>
                    <label for="sinopse">Sinopse:</label>
                    <input type="text" name="sinopse">
                </p>
                <p>
                    <label for="capa">Capa do Filme</label>
                    <input type="file" name="capa">
                </p>
                <p>
                    <button type="submit">Cadastrar</button>
                </p>
            </form>
        </section>
    </main>
</body>

</html>