<!DOCTYPE html>
<html lang="en">
<?php $title = "Home";
require("./components/head.php"); ?>

<body>
    <?php require("./components/nav.php"); ?>

    <main class="container">
        <?php require __DIR__ . "/components/login.php"; ?>

        <form id="teste" hx-get="./components/nav.php" hx-swap="outerHTML">
            <input type="number">
        </form>

        <div></div>

        <ul id="todos" hx-get="./components/todos_list.php" hx-trigger="submit from:#login">
            <?php require_once __DIR__ . "/components/todos_list.php"; ?>
        </ul>

        <form hx-post="./components/add_todo.php" hx-target="#todos" hx-swap="beforeend">
            <label for="todo">
                Task:
                <input type="text" name="todo">
            </label>
        </form>
    </main>

    <?php require("./components/footer.php") ?>
</body>

</html>
