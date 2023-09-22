<?php
require_once __DIR__ . "/../env.php";

try {
    $db = "mysql:host=$host;dbname=$database;charset=utf8";
    $pdo = new PDO($db, $user, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro ao conectar com o banco de dados: " . $e->getMessage();
}
