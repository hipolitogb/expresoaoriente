<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <?php include __DIR__ . '/../components/head.php'; ?>
    <?php
    // JSON-LD for Article
    if ($chapter_content) {
        $jsonld = [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $chapter_content['seo_title'] ?? '',
            'description' => $chapter_content['meta_description'] ?? '',
            'datePublished' => $chapter['date'] ?? '',
            'image' => SITE_URL . BASE_PATH . '/img/' . ($chapter_content['hero_image'] ?? ''),
            'author' => [
                '@type' => 'Organization',
                'name' => SITE_NAME
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => SITE_NAME
            ],
            'inLanguage' => $lang === 'es' ? 'es-AR' : 'en-US'
        ];
        echo '<script type="application/ld+json">' . json_encode($jsonld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
    }
    ?>
</head>
<body class="page-chapter">
    <?php include __DIR__ . '/../components/header.php'; ?>

    <main class="main-content">
        <?php if ($chapter_content): ?>

        <!-- Chapter Hero Image -->
        <?php if (!empty($chapter_content['hero_image'])): ?>
        <section class="chapter-hero">
            <img src="<?= BASE_PATH ?>/img/<?= $chapter_content['hero_image'] ?>"
                 alt="<?= htmlspecialchars($chapter_content['h2'] ?? '') ?>">
            <div class="chapter-hero-content">
                <span class="chapter-hero-id"><?= ($lang === 'es' ? 'Capítulo' : 'Chapter') . ' ' . $chapter['id'] ?></span>
                <h1 class="chapter-hero-title"><?= htmlspecialchars($chapter_content['h2'] ?? '') ?></h1>
                <?php if (!empty($chapter_content['h3'])): ?>
                <p class="chapter-hero-subtitle"><?= htmlspecialchars($chapter_content['h3']) ?></p>
                <?php endif; ?>
            </div>
        </section>
        <?php endif; ?>

        <!-- Chapter Title Bar -->
        <div class="container">
            <div class="chapter-title-bar">
                <h1>
                    <?= ($lang === 'es' ? 'Capítulo' : 'Chapter') ?> #<?= $chapter['id'] ?>.
                    <span class="chapter-title-accent"><?= htmlspecialchars($chapter_content['h2'] ?? '') ?></span>
                </h1>
                <span class="chapter-date">
                    <?= date($lang === 'es' ? 'd.m.Y' : 'm.d.Y', strtotime($chapter['date'])) ?>
                </span>
            </div>
        </div>

        <!-- Chapter Content -->
        <div class="chapter-layout <?= ($chapter_content['layout'] ?? $chapter['layout']) === 'full' ? 'layout-full' : 'layout-sidebar' ?> container">
            <article class="chapter-body">
                <?= $chapter_content['body'] ?? '' ?>
            </article>

            <?php if (($chapter_content['layout'] ?? $chapter['layout']) !== 'full'): ?>
            <aside class="chapter-sidebar">
                <div class="sidebar-box">
                    <h3><?= $strings['follow_us'] ?? 'Follow us' ?></h3>
                    <div class="sidebar-social">
                        <?php global $social; ?>
                        <?php if (!empty($social['facebook'])): ?>
                        <a href="<?= $social['facebook'] ?>" target="_blank" rel="noopener noreferrer">Facebook</a>
                        <?php endif; ?>
                        <?php if (!empty($social['twitter'])): ?>
                        <a href="<?= $social['twitter'] ?>" target="_blank" rel="noopener noreferrer">Twitter</a>
                        <?php endif; ?>
                        <?php if (!empty($social['vimeo'])): ?>
                        <a href="<?= $social['vimeo'] ?>" target="_blank" rel="noopener noreferrer">Vimeo</a>
                        <?php endif; ?>
                        <?php if (!empty($social['youtube'])): ?>
                        <a href="<?= $social['youtube'] ?>" target="_blank" rel="noopener noreferrer">YouTube</a>
                        <?php endif; ?>
                    </div>
                </div>
            </aside>
            <?php endif; ?>
        </div>

        <!-- Chapter Navigation -->
        <div class="container">
            <?php include __DIR__ . '/../components/chapter-nav.php'; ?>
        </div>

        <?php else: ?>
        <!-- No content available -->
        <div class="container">
            <section class="error-page">
                <h1><?= $strings['page_not_found'] ?? 'Content not available' ?></h1>
                <p><?= $lang === 'es' ? 'El contenido de este capítulo aún no está disponible.' : 'This chapter content is not yet available.' ?></p>
                <a href="<?= BASE_PATH ?>/<?= $lang ?>/" class="btn"><?= $strings['back_home'] ?? 'Back to home' ?></a>
            </section>
        </div>
        <?php endif; ?>
    </main>

    <?php include __DIR__ . '/../components/footer.php'; ?>
    <script src="<?= BASE_PATH ?>/js/main.js"></script>
</body>
</html>
