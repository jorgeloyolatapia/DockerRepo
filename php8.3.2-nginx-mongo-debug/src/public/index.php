<?php

    $servername = "mongo";
    $username = "usertest";
    $password = "usertestpwd";
    $dbname = "dbtest";
    
    // Intenta establecer la conexión a MongoDB
    try {
        $mongoClient = new MongoDB\Driver\Manager("mongodb://{$servername}:27017", [
            'username' => $username,
            'password' => $password,
            'db' => $dbname,
        ]);
    
        echo "Conexión exitosa a MongoDB\n";
    
        // Ahora puedes realizar operaciones en la base de datos
    
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo "Error al conectar a MongoDB: " . $e->getMessage() . "\n";
    }
