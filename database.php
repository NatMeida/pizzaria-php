<?php
require("env.php");

try {
    $db = "mysql:host=$host;dbname=$database;charset=utf8";
    $pdo = new PDO($db, $user, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {}
