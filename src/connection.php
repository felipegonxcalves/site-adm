<?php

try{
    $conn = new \PDO("mysql:host=". DB_SERVER .";dbname=" . DB_NAME .";", DB_USER, DB_PASSWORD);
}catch (\PDOException $e){
    echo "Não foi possível estabelecer uma conexão com o banco de dados ". $e->getMessage();exit;
}
