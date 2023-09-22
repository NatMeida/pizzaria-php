<?php 
if (isset($_POST["action"]) && $_POST["action"] == "logout") {
    setcookie("user", "", time() - 3600, "/");
} else if (isset($_POST["user"])) {
    $user = $_POST["user"];
    setcookie("user", $user, time() + 3600 * 24 * 30, "/");
} else if (isset($_COOKIE["user"])) {
    $user = $_COOKIE["user"];
}
?>

<?php if (!isset($user)): ?>
    <input type="text" name="user" placeholder="Usuário">
    <button type="submit" name="action" value="login">Entrar</button>
<?php else: ?>
    <p>Olá, <?= $user ?></p>
    <button type="submit" name="action" value="logout">Sair</button>
<?php endif; ?>
