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
            <h2 align="center">Cadastro de Filme</h2>
            <div class="col-md-5" style="margin:0 auto; float:none;">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="titulo">Titulo do Filme:</label>
                        <input type="text" name="titulo" placeholder="insira o título" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="ano">Ano de Lançamento:</label>
                        <input type="text" name="ano" placeholder="insira o ano" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="sinopse">Sinopse:</label>
                        <input type="text" name="sinopse" placeholder="insira a sinopse" class="form-control"/>
                    </div>
                    <div class="form-group" align="center">
                        <button type="submit" class="btn btn-info">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

</html>