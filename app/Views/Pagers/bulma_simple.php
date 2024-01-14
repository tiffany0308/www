<?php
/**
 * @var \CodeIgniter\Pager\PageRenderer $pager
 */

 $pager->setSurroundCount(0);
?>


<nav class="pagination is-small" role="navigation" aria-label="pagination">
    <?php $currentPage = isset($_GET['page']) ? $_GET['page'] : 1; ?>

    <?php if ($currentPage > 1): ?>
        <a class="pagination-previous is-size-3" href="?page=<?= $currentPage - 1 ?>">&lt;</a>
    <?php else: ?>
        <a class="pagination-previous is-size-3" disabled>&lt;</a>
    <?php endif; ?>

    <?php if ($pager->hasNext()): ?>
        <a class="pagination-next is-size-3" href="?page=<?= $currentPage + 1 ?>">&gt;</a>
    <?php else: ?>
        <a class="pagination-next is-size-3" disabled>&gt;</a>
    <?php endif; ?>
</nav>

