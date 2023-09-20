<?php
require("../database.php");

define("UPLOAD_DIR", "uploads/photos/");
define("UPLOAD_MAX_SIZE", 1024 * 1024 * 5); // 5MB

function insert($nome, $foto, $email, $pagamento, $sabor, $adicionais, $rua, $numero, $bairro, $complemento, $cidade, $estado)
{
    global $pdo;

    if ($foto && $foto["error"] == 0 && $foto["name"] != "" && $foto["size"] > 0) {
        if ($foto["size"] > UPLOAD_MAX_SIZE) {
            echo "<p class='error'>Imagem excede o tamanho máximo permitido</p>";
            return false;
        } else if (!preg_match('/^image\/(jpg|jpeg|png|gif)$/', $foto["type"])) {
            echo "<p class='error'>Formato de imagem inválido!</p>";
            return false;
        }

        $ext = pathinfo($foto["name"], PATHINFO_EXTENSION);
        $filename = uniqid() . ".$ext";
        $filepath = UPLOAD_DIR . $filename;

        if (!move_uploaded_file($foto["tmp_name"], $filepath)) {
            echo "<p class='error'>Erro ao fazer upload da imagem!</p>";
            return false;
        }
    } else {
        $filename = null;
        $filepath = null;
    }

    $smt = $pdo->prepare("INSERT INTO pedidos 
        (cliente, foto, email, pagamento, sabor, adicionais, rua, numero, bairro, cidade, estado) 
        VALUES (:nome, :foto, :email, :pagamento, :sabor, :adicionais, :rua, :numero, :bairro, :cidade, :estado)");
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
    $smt->bindParam(":foto", $filepath);

    try {
        $smt->execute();
    } catch (PDOException $e) {
        echo "<p class='error'>Erro ao cadastrar pedido!</p>";
        echo $e;
        die();
    }


    if ($smt->rowCount() > 0) {
        echo "foi";
        return $pdo->lastInsertId();
    } else if ($filename) {
        unlink($filepath);
    }
}

function select($id = null)
{
    global $pdo;

    if ($id) {
        $smt = $pdo->prepare("SELECT * FROM pedidos WHERE id = :id");
        $smt->bindParam(":id", $id);
    } else {
        $smt = $pdo->prepare("SELECT * FROM pedidos");
    }

    try {
        $smt->execute();
    } catch (PDOException $e) {
        echo "<p class='error'>Erro ao consultar pedidos!</p>";
        echo $e;
        die();
    }

    return $smt->fetchAll();
}

function selectName($name) {
    global $pdo;

    $smt = $pdo->prepare("SELECT * FROM pedidos WHERE cliente LIKE :cliente");
    $smt->bindValue(":cliente", $name . "%");

    $smt->execute();
    return $smt->fetchAll();
}

function update($id, $nome, $foto, $email, $pagamento, $sabor, $adicionais = "", $rua, $numero, $bairro, $complemento, $cidade, $estado)
{
    global $pdo;


    if ($foto && $foto["error"] == 0 && $foto["name"] != "" && $foto["size"] > 0) {
        $smt = $pdo->prepare("SELECT foto FROM pedidos WHERE id = :id");
        $smt->bindParam(":id", $id);
        $smt->execute();
        $fotoAntiga = $smt->fetch()["foto"];

        if ($foto["size"] > UPLOAD_MAX_SIZE || !preg_match("/image\/(jpg|jpeg|png|gif|webp)/", $foto["type"])) {
            echo "<p class='error'>Erro ao fazer upload da imagem!</p>";
            return false;
        }

        $ext = pathinfo($foto["name"], PATHINFO_EXTENSION);
        $filename = uniqid() . ".$ext";
        $filepath = UPLOAD_DIR . $filename;

        if (!move_uploaded_file($foto["tmp_name"], $filepath)) {
            echo "<p class='error'>Erro ao fazer upload da imagem!</p>";
            return false;
        }
    }

    $smt = $pdo->prepare("UPDATE pedidos SET 
        cliente = :nome, 
        email = :email, 
        pagamento = :pagamento, 
        sabor = :sabor, 
        adicionais = :adicionais, 
        rua = :rua, 
        numero = :numero, 
        bairro = :bairro, 
        cidade = :cidade, 
        estado = :estado" 
        . ($filename ? ", foto = :foto" : "") 
        . " WHERE id = :id"
    );

    $smt->bindParam(":id", $id);
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

    if ($filename) {
        $smt->bindParam(":foto", $filepath);
    }

    try {
        $smt->execute();
    } catch (PDOException $e) {
        echo "<p class='error'>Erro ao atualizar pedido!</p>";
        echo $e;
        die();
    }


    if ($smt->rowCount() > 0 && $filename) {
        unlink($fotoAntiga);
    } else if ($filename) {
        unlink($filepath);
    }

    return $smt->rowCount() > 0;
}

function deletePedido($id) {
    global $pdo;

    $smt = $pdo->prepare("SELECT foto FROM pedidos WHERE id = :id");
    $smt->bindParam(":id", $id);
    $smt->execute();
    $foto = $smt->fetch()["foto"];

    $smt = $pdo->prepare("DELETE FROM pedidos WHERE id = :id");
    $smt->bindParam(":id", $id);
    $smt->execute();

    if ($smt->rowCount() > 0 && $foto) {
        unlink($foto);
    }

    return $smt->rowCount() > 0;
}
