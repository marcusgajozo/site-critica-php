<?php
try{
    $database;

    if(!file_exists('database.db')){
        $database = new PDO('sqlite:database.db');
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "CREATE TABLE usuario (
            id INTEGER PRIMARY KEY AUTOINCREMENT, 
            nome VARCHAR (200) NOT NULL,
            email VARCHAR (120) NOT NULL,
            senha VARCHAR (16) NOT NULL);
            
            CREATE TABLE filme (
            id INTEGER PRIMARY KEY AUTOINCREMENT, 
            titulo VARCHAR (200) NOT NULL,
            ano VARCHAR (120) NOT NULL,
            sinopse VARCHAR (500));
            
            CREATE TABLE comentario (
            id_filme INTEGER NOT NULL,
            id_usuario INTEGER NULL,
            comentario VARCHAR (200) NOT NULL);
            
            INSERT INTO usuario(nome, email, senha) VALUES ('admin', 'admin@email.com', 'admin');";
        
        $database-> exec ("$sql");
        echo "entrei";
    }else{
        $database = new PDO('sqlite:database.db');
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

}catch(PDOException $e){
    echo "Error:" . $e->getMessage();
}
