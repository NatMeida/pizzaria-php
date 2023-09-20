<?php
require("../database.php");
require("../lib/crud.php");

if (isset($_GET["cliente"])) {
    $cliente = $_GET["cliente"];
    $clientes = selectName($cliente);
} else {
    $clientes = select();
}
?>

<form action="./consulta.php" class="container">
    <label for="cliente">
        <input type="text" name="cliente" placeholder="Nome do cliente" required>
    </label>

    <div class="grid" style="margin-bottom: var(--spacing); ">
        <a href="./consulta.php" class="secondary" role="button">Limpar busca</a>
        <button type="submit" style="margin-bottom: 0; ">Buscar</button>
    </div>
</form>

<form>
    <table role="grid">
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
            <?php foreach($clientes as $row): ?>
                <tr>
                    <td><input type='radio' name='compra' value='<?= $row["id"] ?>'></td>
                    <td><?= $row["cliente"] ?></td>
                    <td><?= $row["email"] ?></td>
                    <td><?= $row["pagamento"] ?></td>
                    <td><?= $row["sabor"] ?></td>
                    <td><?= $row["adicionais"] ?></td>
                    <td><?= $row["rua"] ?></td>
                    <td><?= $row["cidade"] ?></td>
                    <td><?= $row["estado"] ?></td>
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

    
    <div class="grid">
        <button type="submit" formaction="./excluir.php" class="secondary">Excluir</button>
        <button type="submit" formaction="./cadastro.php">Editar</button>
    </div>
</form>
