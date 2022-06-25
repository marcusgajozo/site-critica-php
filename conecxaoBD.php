<?php
try{
    $database = new PDO('sqlite:database.db');
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE IF NOT EXISTS usuario (
        id INTEGER PRIMARY KEY AUTOINCREMENT, 
        nome VARCHAR (200) NOT NULL,
        email VARCHAR (120) NOT NULL,
        senha VARCHAR (16) NOT NULL);
        
        CREATE TABLE IF NOT EXISTS filme (
        id INTEGER PRIMARY KEY AUTOINCREMENT, 
        titulo VARCHAR (200) NOT NULL,
        ano VARCHAR (120) NOT NULL,
        sinopse VARCHAR (500));
        
        CREATE TABLE IF NOT EXISTS comentario (
        id_filme INTEGER NOT NULL,
        id_usuario INTEGER NULL,
        comentario VARCHAR (200) NOT NULL);";
    
    $database-> exec ("$sql");
}catch(PDOException $e){
    echo "Error:" . $e->getMessage();
}
