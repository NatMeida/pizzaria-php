<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once __DIR__ . "/../lib/crud.php";

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
        $success = update($id, $nome, $foto, $email, $pagamento, $sabor, $adicionais, $rua, $numero, $bairro, $complemento, $cidade, $estado);
    } else {
        $success = insert($nome, $foto, $email, $pagamento, $sabor, $adicionais, $rua, $numero, $bairro, $complemento, $cidade, $estado);
    }

    if ($success) {
        header("Location: ./consulta.php");
    } else {
        echo "<p class='error'>Erro ao cadastrar pedido!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php $title = isset($_GET["compra"]) ? "Edição" : "Cadastro"; require_once __DIR__ . "/../components/head.php"; ?>

<body>
    <?php require_once __DIR__ . "/../components/nav.php"; ?>

    <main>
        <h1>
            <?= isset($_GET["compra"]) ? "Editar pedido" : "Faça seu pedido!" ?>
        </h1>

        <?php require_once __DIR__ . "/../components/form_cadastro.php"; ?>
    </main>

    <?php require_once __DIR__ . "/../components/footer.php"; ?>
</body>

</html>
