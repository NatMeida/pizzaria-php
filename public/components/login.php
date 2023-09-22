<?php 
if (isset($_POST["action"]) && $_POST["action"] == "logout") {
    setcookie("user", "", time() - 3600);
} else if (isset($_POST["user"])) {
    $user = $_POST["user"];
    setcookie("user", $user, time() + 3600 * 24 * 30, "/");
} else if (isset($_COOKIE["user"])) {
    $user = $_COOKIE["user"];
}
?>

<?php if (!isset($user)): ?>
    <form class="grid" id="login" hx-post="./components/login.php" hx-swap="outerHTML">
        <input type="text" name="user" placeholder="Usuário">
        <button type="submit">Entrar</button>
    </form>
<?php else: ?>
    <form class="grid" id="login" hx-post="./components/login.php" hx-swap="outerHTML">
        <p>Olá, <?= $user ?></p>
        <button type="submit" name="action" value="logout">Sair</button>
    </form>
<?php endif; ?>
