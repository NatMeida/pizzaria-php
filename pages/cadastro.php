<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    define("UPLOAD_DIR", "uploads/photos/");
    define("MAX_FILE_SIZE", 1024 * 1024 * 5); // 2MiB


    require("../database.php");

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $pagamento = $_POST["pagamento"];
    $sabor = $_POST["sabor"];

    $rua = $_POST["rua"];
    $numero = $_POST["numero"];
    $bairro = $_POST["bairro"];
    $complemento = isset($_POST["complemento"]) ? $_POST["complemento"] : null;
    $cidade = $_POST["cidade"];
    $estado = $_POST["estado"];

    $foto = $_FILES["foto"];

    if ($foto["size"] < MAX_FILE_SIZE && $foto["name"] != "" && preg_match("/^image\/(jpg|jpeg|png)$/", $foto["type"])) {
        $ext = pathinfo($foto["name"], PATHINFO_EXTENSION);
        $nome_foto = UPLOAD_DIR . uniqid() . ".$ext";
        move_uploaded_file($foto["tmp_name"], $nome_foto);
    } else {
        $nome_foto = null;
    }

    $adicionais = "";
    if (isset($_POST["tomate"]))
        $adicionais .= "tomate, ";

    if (isset($_POST["cebola"]))
        $adicionais .= "cebola, ";

    if (isset($_POST["tomate_seco"]))
        $adicionais .= "tomate seco, ";
    
    if (isset($_POST["cheddar"]))
        $adicionais .= "cheddar, ";

    if (isset($_POST["bacon"]))
        $adicionais .= "bacon, ";

    if ($adicionais == "")
        $adicionais = null;
    else
        $adicionais = substr($adicionais, 0, -2);

    if (isset($_POST["compra"])) {
        $id = $_POST["compra"];

        $smt = $pdo->prepare("UPDATE pedidos SET 
            cliente = :nome, email = :email, pagamento = :pagamento, sabor = :sabor, adicionais = :adicionais, 
            rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, foto = :foto
            WHERE id = :id");
        $smt->bindParam(":id", $id);
    } else {
        $smt = $pdo->prepare("INSERT INTO pedidos 
            (cliente, email, pagamento, sabor, adicionais, rua, numero, bairro, cidade, estado, foto) 
            VALUES (:nome, :email, :pagamento, :sabor, :adicionais, :rua, :numero, :bairro, :cidade, :estado, :foto)");
    }

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
    $smt->bindParam(":foto", $nome_foto);

    try {
        $smt->execute();
    } catch (PDOException $e) {
        echo "<p class='error'>Erro ao cadastrar pedido!</p>";
        echo $e;
        die();
    }

    if ($smt->rowCount() > 0) {
        header("Location: ./consulta.php");
    } else {
        echo "<p class='error'>Erro ao cadastrar pedido!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php $title = isset($_GET["compra"]) ? "Edição" : "Cadastro"; require("../components/head.php") ?>
<body>
    <?php require("../components/nav.php") ?>
    
    <main>
        <h1><?= isset($_GET["compra"]) ? "Editar pedido" : "Faça seu pedido!" ?></h1>
        
        <?php require("../components/form_cadastro.php") ?>
    </main>
    
    <?php require("../components/footer.php") ?>
</body>
</html>