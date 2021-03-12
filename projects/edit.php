<?php




require '../includes/init.php';

$db = require '../includes/db.php';

if (isset($_GET['id'])) {
    // get project
    $project = Project::getById($db, $_GET['id']);
    // get statuses to map out to the select options
    $options = Project::getStatus($db);
    if (!$project) {
        die("project not found");
    }
} else {
    die("id not supplied, project not found");
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $existingProject = new Project($db);


    $existingProject->id = $_GET['id'];

    $existingProject->title = $_POST['title'];
    $existingProject->description = $_POST['description'];
    $existingProject->status = $_POST['status'];
    $existingProject->owner_name = $_POST['owner_name'];
    $existingProject->owner_email = $_POST['owner_email'];


    if ($existingProject->update($_GET['id'])) {

        $mail = new Email($existingProject->owner_email);
        $mail->registerChanges($project, $existingProject);
        if ($mail->sendEmail()) {
            Url::redirect("/");
        }
    }
}

?>
<?php require '../includes/header.php'; ?>


<div class='form'>
    <form id='form' method="post">
        <div class='form__inner'>

            <label for="title">Cím</label>
            <input name='title' id='title' type='text' value="<?= htmlspecialchars($project['title']); ?>" />
            <label for="description">Leírás</label>
            <textarea name='description' row='3'><?= htmlspecialchars($project['description']); ?></textarea>

            <label for="status">Státusz</label>
            <select name="status">
                <!-- map out the options for the statuses -->
                <?php foreach ($options as $option) : ?>

                    <?php if ($option['key'] == $project['status']) : ?>

                        <option selected='selected' value="<?= $option['key'] ?>"><?= $option['name'] ?></option>

                    <?php else : ?>

                        <option value="<?= $option['key'] ?>"><?= $option['name'] ?></option>

                    <?php endif; ?>
                <?php endforeach; ?>

            </select>
            <label for="owner_name">Kapcsolattartó neve</label>
            <input name='owner_name' id='owner_name' type='text' value="<?= htmlspecialchars($project['owner_name']); ?>" />
            <label for="owner_email">Kapcsolattartó e-mail címe</label>
            <input name='owner_email' id='owner_email' type='email' value="<?= htmlspecialchars($project['owner_email']); ?>" />
            <button>Mentés</button>
        </div>
    </form>
</div>



<?php require '../includes/footer.php'; ?>