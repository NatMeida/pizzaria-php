<?php
if (!isset($_GET["compra"])) {
    header("Location: ./consulta.php");
    exit;
}

require("../lib/crud.php");

$id = $_GET["compra"];

if (isset($_GET["excluir"]) && $_GET["excluir"] == "true") {
    deletePedido($id);
} else if (isset($_GET["excluir"]) && $_GET["excluir"] == "false") {
    header("Location: ./consulta.php");
    exit;
} else {
    $compra = select($id)[0];
}

if (isset($_GET["excluir"]) && $_GET["excluir"] == "true") {
    header("Location: ./consulta.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<?php $title = "Excluir";
require("./components/head.php") ?>

<body>
    <?php require("./components/nav.php") ?>

    <main>
        <article>
            <header>
                <?= $compra["cliente"] ?> - Pizza
                <?= $compra["sabor"] ?>
            </header>
            Você tem certeza que deseja excluir essa compra?
            <footer>
                <form action="./excluir.php" class="grid">
                    <input type="hidden" name="compra" value="<?= $compra["id"] ?>">
                    <button type="submit" name="excluir" value="true">Excluir</button>
                    <button type="submit" name="excluir" value="false" class="contrast">Cancelar</button>
                </form>
            </footer>
        </article>
    </main>

    <?php require("./components/footer.php") ?>
</body>

</html>