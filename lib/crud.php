<?php
require("../database.php");

function insert($nome, $email, $pagamento, $sabor, $adicionais, $rua, $numero, $bairro, $complemento, $cidade, $estado) {
    global $pdo;
    
    $smt = $pdo->prepare("INSERT INTO pedidos 
        (cliente, email, pagamento, sabor, adicionais, rua, numero, bairro, cidade, estado) 
        VALUES (:nome, :email, :pagamento, :sabor, :adicionais, :rua, :numero, :bairro, :complemento, :cidade, :estado)");    
    $smt->bindParam(":nome", $nome);
    $smt->bindParam(":email", $email);
    $smt->bindParam(":pagamento", $pagamento);
    $smt->bindParam(":sabor", $sabor);
    $smt->bindParam(":adicionais", $adicionais);
    $smt->bindParam(":rua", $rua);
    $smt->bindParam(":numero", $numero);
    $smt->bindParam(":bairro", $bairro);
    $smt->bindParam(":cidade", $cidade);
    $smt->bindParam(":estado", $estado);

    $smt->execute();

    return $smt->rowCount() > 0;
}

function select() {
    global $pdo;

    $smt = $pdo->prepare("SELECT * FROM pedidos");
    $smt->execute();

    return $smt;
}

function selectById($id) {
    global $pdo;

    $smt = $pdo->prepare("SELECT * FROM pedidos WHERE id = :id");
    $smt->bindParam(":id", $id);
    $smt->execute();

    return $smt;
}
