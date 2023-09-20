<?php
if (isset($_GET["compra"])) {
    require("../lib/crud.php");

    $id = $_GET["compra"];
    $user = select($id)[0];

    $update = true;

    if (!$user) {
        header("Location: ./consulta.php");
        exit;
    }
}
?>

<form action="./cadastro.php" method="post" enctype="multipart/form-data">
    <?php 
    if ($update) {
        echo "<input type='hidden' name='compra' value='{$user["id"]}'>";
    }
    ?>

    <div class="grid">
        <input type="text" name="nome" placeholder="Nome" value="<?= $user["cliente"] ?>" required>
        <input type="email" name="email" placeholder="Email" value="<?= $user["email"] ?>" required>
        <select name="pagamento" value="<?= $user["pagamento"] ?>" required>
            <option>Selecione uma forma de pagamento...</option>
            <option value="dinheiro">Dinheiro</option>
            <option value="cartao">Cartão</option>
        </select>
    </div>

    <select name="sabor" value="<?= $user["sabor"] ?>" required>
        <option>Selecione um sabor...</option>
        <option value="margherita">Margherita</option>
        <option value="calabresa">Calabresa</option>
        <option value="portuguesa">Portuguesa</option>
        <option value="quatro_queijos">Quatro Queijos</option>
        <option value="frango_catupiry">Frango com Catupiry</option>
        <option value="bacon">Bacon</option>
    </select>

    <fieldset class="grid">
        <legend>Adicionais</legend>

        <label for="tomate">
            <input type="checkbox" name="tomate">
            Tomate
        </label>
        <label for="cebola">
            <input type="checkbox" name="bacon">
            Cebola
        </label>
        <label for="tomate_seco">
            <input type="checkbox" name="tomate_seco">
            Tomate Seco
        </label>

        <label for="cheddar">
            <input type="checkbox" name="cheddar">
            Cheddar
        </label>
        <label for="bacon">
            <input type="checkbox" name="bacon">
            Bacon
        </label>
    </fieldset>

    <hr>

    <fieldset>
        <legend>Endereço</legend>
        <input type="text" name="rua" placeholder="Rua" value="<?= $user["rua"] ?>" required>
        <div class="grid">
            <input type="text" name="numero" placeholder="Número" value="<?= $user["cliente"] ?>" required>
            <input type="text" name="bairro" placeholder="Bairro" value="<?= $user["bairro"] ?>" required>
            <input type="text" name="complemento" placeholder="Complemento">
        </div>
        <div class="grid">
            <input type="text" name="cidade" placeholder="Cidade" value="<?= $user["cidade"] ?>" required>
            <input type="text" name="estado" placeholder="Estado" value="<?= $user["estado"] ?>"required>
        </div>
    </fieldset>

    <div>
        <label for="foto">Foto da pizza:</label>
        <input type="file" name="foto" accept="image/png, image/jpeg, image/jpg">
    </div>

    <button type="submit">Enviar</button>
</form>
