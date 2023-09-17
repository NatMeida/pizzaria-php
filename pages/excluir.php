<?php 
if (!isset($_GET["compra"])) {
    header("Location: ./consulta.php");
    exit;
}

require("../database.php");

$id = $_GET["compra"];

if (isset($_GET["excluir"]) && $_GET["excluir"] == "true") {
    $smt = $pdo->prepare("DELETE FROM pedidos WHERE id = :id");
} else {
    $smt = $pdo->prepare("SELECT * FROM pedidos WHERE id = :id");
}

$smt->bindParam(":id", $id);

try {
    $smt->execute();
} catch (PDOException $e) {
    echo "<p class='error'>Erro ao consultar pedido!</p>";
    echo $e;
    die();
}

if (isset($_GET["excluir"]) && $_GET["excluir"] == "true") {
    header("Location: ./consulta.php");
    die();
}

if ($smt->rowCount() == 0) {
    header("Location: ./consulta.php");
    exit;
}

$compra = $smt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<?php $title = "Excluir"; require("../components/head.php") ?>

<body>
    <?php require("../components/nav.php") ?>

    <main>
        <article>
            <header><?= $compra["cliente"] ?> - Pizza <?= $compra["sabor"]  ?> </header>
            Você tem certeza que deseja excluir essa compra?
            <footer>
                <form action="./excluir.php" class="grid">
                    <input type="hidden" name="compra" value="<?= $compra["id"] ?>">
                    <button type="submit" name="excluir" value="true">Excluir</button>
                    <button type="submit" class="contrast">Cancelar</button>
                </form>
            </footer>
        </article>
    </main>

    <?php require("../components/footer.php") ?>
</body>

</html>