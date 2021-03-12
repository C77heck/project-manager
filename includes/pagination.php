<ul class="pagination">
    <li>
        <?php if ($pagination->previous) : ?>
            <a href="index.php?page=<?= $pagination->previous; ?>">Previous</a>
        <?php else : ?>
            <!-- "disable" if no further pages -->
            <span class="page-link--disabled">Previous</span>
        <?php endif; ?>
    </li>
    <li>
        <?php if ($pagination->next) : ?>
            <a href="index.php?page=<?= $pagination->next; ?>">Next</a>
        <?php else : ?>
            <!-- "disable" if no further pages -->
            <span class="page-link--disabled">Next</span>
        <?php endif; ?>
    </li>
</ul>