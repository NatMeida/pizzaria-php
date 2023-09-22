<?php 
if (isset($_COOKIE["user"])) {
    require_once __DIR__ . "/../../lib/database.php";
    $user = $_COOKIE["user"];

    $smt = $pdo->prepare("SELECT * FROM todos WHERE user = :user");
    $smt->bindParam(":user", $user);

    try {
        $smt->execute();
    } catch (PDOException $e) {
        echo "Erro ao buscar todos os todos: " . $e->getMessage();
        die();
    }

    $todos = $smt->fetchAll();
}
?>

<?php foreach ($todos as $todo): ?>
    <li><?= $todo["task"] ?></li>
<?php endforeach; ?>
