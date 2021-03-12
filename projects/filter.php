<?php

require '../includes/init.php';

$db = require '../includes/db.php';

if (isset($_GET['filter'])) {
    $pagination = new Pagination($_GET['page'] ?? 1, 10, Project::getFilterCount($db, $_GET['filter']));
    $projects = Project::filterByStatus($db, $pagination->limit, $pagination->offset, $_GET['filter']);
}

?>

<?php require '../includes/header.php'; ?>


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

<script>
    const deleteAsync = async (id) => {
        // confirm intent
        if (confirm('Biztos hogy törölni akarod?')) {
            try {
                const responseData = await fetch(
                    'http://localhost/projects/delete.php', {
                        method: 'DELETE',
                        body: JSON.stringify({
                            id: id
                        })
                    }
                )
                console.log(responseData);
                // remove project visually
                document.querySelector(`.project${id}`).style.display = 'none'

            } catch (err) {
                alert('Törlés sikertelen. Kérlek próbáld meg késöbb.')
            }
        }
    }
</script>
<?php require '../includes/pagination.php'; ?>
<?php require '../includes/footer.php'; ?>