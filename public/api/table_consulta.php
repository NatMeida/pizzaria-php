<?php
require_once __DIR__ . "/../../lib/crud.php";
require_once __DIR__ . "/../../lib/database.php";

if (isset($_GET["cliente"])) {
    $cliente = $_GET["cliente"];

    if (isset($_GET["sort"])) {
        $sortBy = $_GET["sort"];

        $smt = $pdo->prepare("SELECT * FROM pedidos WHERE cliente = :nome ORDER BY :column");
        $smt->bindParam(":nome", $cliente);

        $smt->bindParam(":column", $sortBy);

        $smt->execute();
        $clientes = $smt->fetchAll();
    } else {
        $clientes = selectName($cliente);
    }
} else {
    if (isset($_GET["sort"])) {
        $sortBy = $_GET["sort"];
        
        $smt = $pdo->prepare("SELECT * FROM pedidos ORDER BY $sortBy");
        $smt->execute();
        $clientes = $smt->fetchAll();
    } else {
        $clientes = select();
    }
}
?>

<table role="grid" id="table_consulta">
    <thead>
        <tr>
            <th></th>
            <th
                hx-get="./api/table_consulta.php?sort=cliente"
                hx-target="#table_consulta"
                hx-swap="outerHTML"
            >Nome</th>

            <th
                hx-get="./api/table_consulta.php?sort=email"
                hx-target="#table_consulta"
                hx-swap="outerHTML"
            >Email</th>

            <th
                hx-get="./api/table_consulta.php?sort=pagamento"
                hx-target="#table_consulta"
                hx-swap="outerHTML"
            >Pagamento</th>

            <th
                hx-get="./api/table_consulta.php?sort=sabor"
                hx-target="#table_consulta"
                hx-swap="outerHTML">Sabor</th>

            <th
                hx-get="./api/table_consulta.php?sort=adicionais"
                hx-target="#table_consulta"
                hx-swap="outerHTML">Adicionais</th>

            <th>Rua</th>
            <th>Cidade</th>
            <th>Estado</th>
            <th>Foto</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($clientes as $row): ?>
            <tr>
                <td><input type='radio' name='compra' value='<?= $row["id"] ?>'></td>
                <td>
                    <?= $row["cliente"] ?>
                </td>
                <td>
                    <?= $row["email"] ?>
                </td>
                <td>
                    <?= $row["pagamento"] ?>
                </td>
                <td>
                    <?= $row["sabor"] ?>
                </td>
                <td>
                    <?= $row["adicionais"] ?>
                </td>
                <td>
                    <?= $row["rua"] ?>
                </td>
                <td>
                    <?= $row["cidade"] ?>
                </td>
                <td>
                    <?= $row["estado"] ?>
                </td>
                <td>
                    <?php if (isset($row["foto"])): ?>
                        <img src='<?= $row["foto"] ?>' width='60px'>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>