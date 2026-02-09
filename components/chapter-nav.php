<?php
/**
 * Chapter navigation (prev/next)
 * Expects: $prev_chapter, $next_chapter, $lang, $chapters (global)
 */
$ch_prefix = $lang === 'es' ? 'capitulos' : 'chapters';
$slug_key = 'slug_' . $lang;
$prev_label = $strings['prev_chapter'] ?? ($lang === 'es' ? 'Capítulo anterior' : 'Previous chapter');
$next_label = $strings['next_chapter'] ?? ($lang === 'es' ? 'Siguiente capítulo' : 'Next chapter');
$all_label = $strings['all_chapters'] ?? ($lang === 'es' ? 'Todos los capítulos' : 'All chapters');
?>

<nav class="chapter-pagination" aria-label="<?= $lang === 'es' ? 'Navegación de capítulos' : 'Chapter navigation' ?>">
    <?php if ($prev_chapter): ?>
    <a href="<?= BASE_PATH ?>/<?= $lang ?>/<?= $ch_prefix ?>/<?= $prev_chapter[$slug_key] ?>" class="chapter-pagination-link chapter-pagination-prev">
        <span class="chapter-pagination-label"><?= $prev_label ?></span>
        <span class="chapter-pagination-id"><?= $lang === 'es' ? 'Cap.' : 'Ch.' ?> <?= $prev_chapter['id'] ?></span>
    </a>
    <?php else: ?>
    <span class="chapter-pagination-link chapter-pagination-prev is-disabled"></span>
    <?php endif; ?>

    <a href="<?= BASE_PATH ?>/<?= $lang ?>/" class="chapter-pagination-link chapter-pagination-all">
        <span class="chapter-pagination-label"><?= $all_label ?></span>
    </a>

    <?php if ($next_chapter): ?>
    <a href="<?= BASE_PATH ?>/<?= $lang ?>/<?= $ch_prefix ?>/<?= $next_chapter[$slug_key] ?>" class="chapter-pagination-link chapter-pagination-next">
        <span class="chapter-pagination-label"><?= $next_label ?></span>
        <span class="chapter-pagination-id"><?= $lang === 'es' ? 'Cap.' : 'Ch.' ?> <?= $next_chapter['id'] ?></span>
    </a>
    <?php else: ?>
    <span class="chapter-pagination-link chapter-pagination-next is-disabled"></span>
    <?php endif; ?>
</nav>
