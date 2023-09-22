<!DOCTYPE html>
<html lang="en">
<?php $title = "Home"; require "../components/head.php"; ?>

<body>
    <?php require "../components/nav.php"; ?>

    <main class="container">
        <?php require "../components/form_login.php"; ?>

        <form hx-post="./api/add_todo.php" hx-target="#todos" hx-swap="afterbegin">
            <label for="todo">
                Task:
                <input type="text" name="todo">
            </label>
        </form>

        <ul id="todos" hx-get="./api/todos_list.php" hx-trigger="submit from:#login" hx-sync="#login:queue last">
            <?php require "./api/todos_list.php"; ?>
        </ul>
    </main>

    <?php require "../components/footer.php"; ?>
</body>

</html>
