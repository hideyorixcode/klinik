<?php
/**
 * @var \CodeIgniter\Pager\PagerRenderer $pager
 */

//$pager->setSurroundCount(2);
?>
<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
    <ul class="pagination">
        <?php if ($pager->hasPreviousPage()) : ?>
            <li class="page-item">
                <a href="javascript:void(0);" id="<?= $pager->getFirst() ?>" class="page-link"
                   aria-label="<?= lang('Pager.first') ?>">
                    <span aria-hidden="true"><?= lang('Pager.first') ?></span>
                </a>
            </li>
            <li class="page-item">
                <a href="javascript:void(0);" id="<?= $pager->getPreviousPage() ?>" class="page-link"
                   aria-label="<?= lang('Pager.previous') ?>">
                    <span aria-hidden="true"><?= lang('Pager.previous') ?></span>
                </a>
            </li>
        <?php endif ?>
        <?php if(count($pager->links())>1) : ?>
        <?php foreach ($pager->links() as $link) : ?>
            <li aria-current="page" <?= $link['active'] ? 'class="page-item active"' : 'class="page-item"' ?>>
                <a class="page-link" id="<?= $link['uri'] ?>" href="javascript:void(0);">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>
        <?php endif; ?>


        <?php if ($pager->hasNextPage()) : ?>
            <li class="page-item">
                <a href="javascript:void(0);" id="<?= $pager->getNextPage() ?>" class="page-link"
                   aria-label="<?= lang('Pager.next') ?>">
                    <span aria-hidden="true"><?= lang('Pager.next') ?></span>
                </a>
            </li>
            <li class="page-item">
                <a href="javascript:void(0);" id="<?= $pager->getLast() ?>" class="page-link"
                   aria-label="<?= lang('Pager.last') ?>">
                    <span aria-hidden="true"><?= lang('Pager.last') ?></span>
                </a>
            </li>
        <?php endif ?>
    </ul>
</nav>

