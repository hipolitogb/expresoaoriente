<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <?php include __DIR__ . '/../components/head.php'; ?>
    <?php
    // JSON-LD for WebSite
    $jsonld = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => SITE_NAME,
        'url' => SITE_URL,
        'description' => $seo['description'],
        'inLanguage' => $lang === 'es' ? 'es-AR' : 'en-US'
    ];
    ?>
    <script type="application/ld+json"><?= json_encode($jsonld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
</head>
<body class="page-home">
    <?php include __DIR__ . '/../components/header.php'; ?>

    <main class="main-content">
        <!-- Carousel -->
        <section class="chapter-carousel" id="chapter-carousel" aria-label="<?= $strings['all_chapters'] ?? 'All chapters' ?>">
            <div class="carousel-track">
                <?php
                $reversed = array_reverse($chapters);
                foreach ($reversed as $i => $ch):
                    $slug_key = 'slug_' . $lang;
                    $json_key = 'json_' . $lang;
                    $ch_prefix = $lang === 'es' ? 'capitulos' : 'chapters';
                    $ch_url = BASE_PATH . '/' . $lang . '/' . $ch_prefix . '/' . $ch[$slug_key];

                    // Try to load chapter JSON for title/subtitle
                    $ch_json_file = __DIR__ . '/../content/' . $lang . '/chapters/' . $ch[$json_key] . '.json';
                    $ch_data = file_exists($ch_json_file) ? json_decode(file_get_contents($ch_json_file), true) : null;

                    $title = $ch_data['h2'] ?? ucwords(str_replace('-', ' ', $ch[$slug_key]));
                    $subtitle = $ch_data['h3'] ?? '';
                    $chapter_label = ($lang === 'es' ? 'Capítulo' : 'Chapter') . ' ' . $ch['id'];
                    $date_formatted = date($lang === 'es' ? 'd/m/Y' : 'm/d/Y', strtotime($ch['date']));
                ?>
                <a href="<?= $ch_url ?>" class="carousel-slide" aria-label="<?= $chapter_label ?>: <?= htmlspecialchars($title) ?>">
                    <img src="<?= BASE_PATH ?>/img/<?= $ch['hero'] ?>"
                         alt="<?= htmlspecialchars($title) ?>"
                         class="carousel-slide-image"
                         loading="<?= $i === 0 ? 'eager' : 'lazy' ?>">
                    <span class="carousel-chapter-number"><?= strtoupper($ch['id']) ?></span>
                    <span class="carousel-chapter-date"><?= $date_formatted ?></span>
                    <div class="carousel-slide-content">
                        <span class="carousel-chapter-id"><?= strtoupper($chapter_label) ?></span>
                        <h2 class="carousel-chapter-title"><?= htmlspecialchars($title) ?></h2>
                        <?php if ($subtitle): ?>
                        <p class="carousel-chapter-subtitle"><?= htmlspecialchars($subtitle) ?></p>
                        <?php endif; ?>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>

            <button class="carousel-arrow carousel-prev" aria-label="<?= $strings['prev_chapter'] ?? 'Previous' ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
            </button>
            <button class="carousel-arrow carousel-next" aria-label="<?= $strings['next_chapter'] ?? 'Next' ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
            </button>
        </section>

        <!-- Chapter dots -->
        <nav class="carousel-dots" aria-label="<?= $lang === 'es' ? 'Índice de capítulos' : 'Chapter index' ?>">
            <?php foreach ($reversed as $i => $ch): ?>
            <button class="carousel-dot <?= $i === 0 ? 'is-active' : '' ?>"
                    aria-label="<?= ($lang === 'es' ? 'Capítulo' : 'Chapter') . ' ' . $ch['id'] ?>"
                    aria-current="<?= $i === 0 ? 'true' : 'false' ?>">
                <?= $ch['id'] ?>
            </button>
            <?php endforeach; ?>
        </nav>

        <!-- Chapters grid -->
        <section class="container">
            <div class="chapters-grid">
                <?php foreach ($reversed as $ch):
                    $slug_key = 'slug_' . $lang;
                    $json_key = 'json_' . $lang;
                    $ch_prefix = $lang === 'es' ? 'capitulos' : 'chapters';
                    $ch_url = BASE_PATH . '/' . $lang . '/' . $ch_prefix . '/' . $ch[$slug_key];

                    $ch_json_file = __DIR__ . '/../content/' . $lang . '/chapters/' . $ch[$json_key] . '.json';
                    $ch_data = file_exists($ch_json_file) ? json_decode(file_get_contents($ch_json_file), true) : null;

                    $title = $ch_data['h2'] ?? ucwords(str_replace('-', ' ', $ch[$slug_key]));
                    $subtitle = $ch_data['h3'] ?? '';
                ?>
                <a href="<?= $ch_url ?>" class="chapter-card">
                    <div class="chapter-card-image">
                        <img src="<?= BASE_PATH ?>/img/<?= $ch['hero'] ?>"
                             alt="<?= htmlspecialchars($title) ?>"
                             loading="lazy">
                    </div>
                    <div class="chapter-card-body">
                        <span class="chapter-card-id"><?= ($lang === 'es' ? 'Capítulo' : 'Chapter') . ' ' . $ch['id'] ?></span>
                        <h3 class="chapter-card-title"><?= htmlspecialchars($title) ?></h3>
                        <?php if ($subtitle): ?>
                        <span class="chapter-card-subtitle"><?= htmlspecialchars($subtitle) ?></span>
                        <?php endif; ?>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <?php include __DIR__ . '/../components/footer.php'; ?>
    <script src="<?= BASE_PATH ?>/js/main.js"></script>
</body>
</html>
