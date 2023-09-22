<!DOCTYPE html>
<html lang="en">
<?php $title = "Consulta"; require "../components/head.php" ?>

<body>
    <?php require "../components/nav.php" ?>

    <main>
        <form action="./consulta.php" class="container" hx-get="./api/table_consulta.php"
            hx-target="#table_consulta" hx-swap="outerHTML">
            <label for="cliente">
                <input type="text" name="cliente" placeholder="Nome do cliente">
            </label>

            <div class="grid" style="margin-bottom: var(--spacing); ">
                <button type="reset" href="consulta.php" class="secondary" hx-get="./api/table_consulta.php"
                    hx-target="#table_consulta" hx-swap="outerHTML">Limpar busca</button>
                <button type="submit">Buscar</button>
            </div>
        </form>

        <form>
            <?php require "./api/table_consulta.php"; ?>

            <div class="grid">
                <button type="submit" formaction="./excluir.php" class="secondary">Excluir</button>
                <button type="submit" formaction="./cadastro.php">Editar</button>
            </div>
        </form>
    </main>

    <?php require_once __DIR__ . "/../components/footer.php" ?>
</body>

</html>