<?php
require('conecxaoBD.php');
if (!isset($_SESSION)) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Critica de Filme</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <div class="menu">
            <div id="logo">
                <a href="index.php"><img src="img/pipoca.png" alt="Logo"></a>
            </div>
            <?php
            if (!isset($_SESSION['id'])) {
            ?>
                <nav>
                    <a href="entrar.php">Entrar</a>
                    <a href="cadastro.php">Cadastrar-se</a>
                </nav>
            <?php
            } else {
            ?>
                <nav>                    
                    <a><?php echo $_SESSION['nome'] ?></a>
                    <?php if($_SESSION['nome'] == 'admin'){
                        echo '<a href="cadastroFilme.php">Cadastrar filme</a>';
                    }
                    ?>
                    <a id="sair" href="sair.php">Sair</a>
                </nav>
            <?php
            }
            ?>
        </div>
    </header>

    <main>
        <section>
            <?php if (!isset($_GET['id_filme'])) { ?>
                <h1 style="text-align: center;
                margin-top: 40px;">Críticas de Filmes</h1>
                <div class="lista_filmes">
                    <?php
                    $filme = $database->query("SELECT id, titulo  FROM filme;");
                    while ($linha = $filme->fetch()) {
                    ?>
                        <form action="index.php" method="get">
                            <button class="link_filme" type="submit" name="id_filme" value="<?php echo $linha['id']; ?>">
                                
                                    <?php echo $linha['titulo']; ?>
                                
                            </button>
                        </form>
                    <?php
                    }
                    ?>
                </div>
            <?php
            } else if (!isset($_SESSION['id'])) {
                header("Location: entrar.php");
            } else {
                $id_filme = $_GET['id_filme'];

                function getIdFilme($id_filme){
                    return $id_filme;
                }

                $info_filme = $database->query("SELECT * FROM filme WHERE id = '$id_filme';");
                $comentario = $database->query("SELECT nome, comentario FROM filme f
                                                INNER JOIN comentario c
                                                on f.id = c.id_filme
                                                INNER JOIN usuario u
                                                on u.id = c.id_usuario
                                                WHERE f.id = '$id_filme';");
                $filme = $info_filme->fetch();
            ?>
                <h1><?php echo $filme['titulo']; ?></h1>
                <p>Ano de Lançamento:<?php echo $filme['ano']; ?></p>
                <p>Sinopse: <?php echo $filme['sinopse']; ?></p>
                <h3>Área de Comentário</h3>
                <?php
                while ($linha = $comentario->fetch()) {
                ?>
                    <div>
                        <div>
                            <b><?php echo $linha['nome']; ?></b>
                        </div>
                        <div>
                            <?php echo $linha['comentario']; ?>
                        </div>
                    </div>
                <?php
                }
                ?>
                <p>
                <form action="" method="post">
                    <label for="comentario">Comentário</label>
                    <input type="text" name="comentario">
                    <button type="submit">Enviar</button>
                </form>
                </p>
            <?php
            }
            if (isset($_POST['comentario'])) {
                if (strlen($_POST['comentario']) == 0) {
                    echo "Preencha sua comentário para envio!";
                } else {
                    $stmt = $database->prepare('INSERT INTO comentario (id_filme, id_usuario, comentario) VALUES(:id_filme, :id_usuario, :comentario)');
                    $stmt->execute(array(
                        ':id_filme' => $id_filme,
                        ':id_usuario' => $_SESSION['id'],
                        ':comentario' => $_POST['comentario']
                    ));
                }
            }
            ?>
        </section>
    </main>
    <footer>
    </footer>

</body>

</html>