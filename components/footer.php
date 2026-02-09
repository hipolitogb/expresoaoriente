<?php
global $social;
$footer_text = $lang === 'es'
    ? 'Tres personas. Ocho meses. Un viaje por el mundo.'
    : 'Three people. Eight months. A journey around the world.';
?>

<footer class="site-footer">
    <div class="footer-inner">
        <a class="footer-logo" href="<?= BASE_PATH ?>/<?= $lang ?>/" aria-label="<?= SITE_NAME ?>">
            <span><?= SITE_NAME ?></span>
        </a>

        <p class="footer-tagline"><?= $footer_text ?></p>

        <div class="footer-social">
            <?php if (!empty($social['facebook'])): ?>
            <a href="<?= $social['facebook'] ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="social-link social-facebook">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            </a>
            <?php endif; ?>
            <?php if (!empty($social['twitter'])): ?>
            <a href="<?= $social['twitter'] ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter" class="social-link social-twitter">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
            </a>
            <?php endif; ?>
            <?php if (!empty($social['vimeo'])): ?>
            <a href="<?= $social['vimeo'] ?>" target="_blank" rel="noopener noreferrer" aria-label="Vimeo" class="social-link social-vimeo">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M23.977 6.416c-.105 2.338-1.739 5.543-4.894 9.609-3.268 4.247-6.026 6.37-8.29 6.37-1.409 0-2.578-1.294-3.553-3.881L5.322 11.4C4.603 8.816 3.834 7.522 3.01 7.522c-.179 0-.806.378-1.881 1.132L0 7.197c1.185-1.044 2.351-2.084 3.501-3.128C5.08 2.701 6.266 1.984 7.055 1.91c1.867-.18 3.016 1.1 3.447 3.838.465 2.953.789 4.789.971 5.507.539 2.45 1.131 3.674 1.776 3.674.502 0 1.256-.796 2.265-2.385 1.004-1.589 1.54-2.797 1.612-3.628.144-1.371-.395-2.061-1.614-2.061-.574 0-1.167.121-1.777.391 1.186-3.868 3.434-5.757 6.762-5.637 2.473.06 3.628 1.664 3.493 4.797l-.013.01z"/></svg>
            </a>
            <?php endif; ?>
            <?php if (!empty($social['youtube'])): ?>
            <a href="<?= $social['youtube'] ?>" target="_blank" rel="noopener noreferrer" aria-label="YouTube" class="social-link social-youtube">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
            </a>
            <?php endif; ?>
        </div>

        <p class="footer-copy">&copy; <?= date('Y') ?> <?= SITE_NAME ?>. <?= $strings['all_rights'] ?? 'Todos los derechos reservados.' ?></p>
    </div>
</footer>
