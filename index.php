<?php

require 'includes/init.php';

$db = require 'includes/db.php';



$pagination = new Pagination($_GET['page'] ?? 1, 10,  Project::getProjectCount($db));
$projects = Project::getPage($db, $pagination->limit, $pagination->offset);

?>

<?php require 'includes/header.php'; ?>


<div class='projects'>
    <?php foreach ($projects as $project) : ?>
        <div class="projects__inner project<?= $project['id']  ?>">
            <div class='projects__upper'>
                <h2><?= $project['title'] ?></h2>
                <p><?= $project['status'] ?></p>
            </div>
            <p><?= $project['owner_name'] ?> <?= $project['owner_email'] ?></p>

            <div class='projects__lower'>
                <a class='btn btn--edit' href="/projects/edit.php?id=<?= $project['id']  ?>">
                    Szerkeztés
                </a>
                <button class='btn btn--delete' onclick="deleteAsync(<?= $project['id']  ?>)" data-id=<?= $project['id']  ?>>
                    Törlés
                </button>
            </div>
        </div>
    <?php endforeach; ?>
</div>


<?php require 'includes/pagination.php'; ?>
<?php require 'includes/footer.php'; ?>