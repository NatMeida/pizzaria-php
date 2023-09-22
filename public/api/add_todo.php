<?php
require __DIR__ . "/../../lib/database.php";

if (isset($_POST["todo"]) && isset($_COOKIE["user"])) {
    $task = $_POST["todo"];
    $user = $_COOKIE["user"];

    $smt = $pdo->prepare("INSERT INTO todos (task, user) VALUES (:task, :user)");
    $smt->bindParam(":task", $task);
    $smt->bindParam(":user", $user);
    
    try {
        $smt->execute();
    } catch (PDOException $e) {
        echo "Erro ao inserir todo: " . $e->getMessage();
        die();
    }

    $success = $smt->rowCount() > 0;
} else {
    $success = false;
}
?>

<?php if ($success): ?>
    <li><?= $task ?></li>
<?php endif; ?>
