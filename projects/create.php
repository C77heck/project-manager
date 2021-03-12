<?php

require '../includes/init.php';

$db = require '../includes/db.php';

$newProject = new Project($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $newProject->title = $_POST['title'];
    $newProject->description = $_POST['description'];
    $newProject->status = $_POST['status'];
    $newProject->owner_name = $_POST['owner_name'];
    $newProject->owner_email = $_POST['owner_email'];

    if ($newProject->create()) {
        Url::redirect("/");
    }
}


?>
<?php require '../includes/header.php'; ?>




<div class='form'>
    <form id='form' method="post">
        <div class='form__inner'>
            <label for="title">Cím</label>
            <input name='title' id='title' type='text' value="<?= htmlspecialchars($newProject->title); ?>" />
            <label for="description">Leírás</label>
            <textarea name='description' row='3'><?= htmlspecialchars($newProject->description); ?></textarea>

            <label for="status">Státusz</label>
            <select name="status" id="status">
                <option value="todo">Fejleszés vár</option>
                <option value="in_progress">Folyamatban</option>
                <option value="done">Kész</option>
            </select>
            <label for="owner_name">Kapcsolattartó neve</label>
            <input name='owner_name' id='owner_name' type='text' value="<?= htmlspecialchars($newProject->owner_name); ?>" />
            <label for="owner_email">Kapcsolattartó e-mail címe</label>
            <input name='owner_email' id='owner_email' type='email' value="<?= htmlspecialchars($newProject->owner_email); ?>" />
            <button>Mentés</button>
        </div>
    </form>

    <?php require '../includes/footer.php'; ?>