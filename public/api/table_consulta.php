<?php
require_once __DIR__ . "/../../lib/crud.php";

if (isset($_GET["cliente"])) {
    $cliente = $_GET["cliente"];
    $clientes = selectName($cliente);
} else {
    $clientes = select();
}
?>

<table role="grid" id="table_consulta">
    <thead>
        <tr>
            <th></th>
            <th>Nome</th>
            <th>Email</th>
            <th>Pagamento</th>
            <th>Sabor</th>
            <th>Adicionais</th>
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