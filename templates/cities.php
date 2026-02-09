<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <?php include __DIR__ . '/../components/head.php'; ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="">
</head>
<body class="page-cities">
    <?php include __DIR__ . '/../components/header.php'; ?>

    <main class="main-content">
        <section class="cities-page">
            <h1><?= htmlspecialchars($page_content['h1'] ?? ($lang === 'es' ? 'Ciudades Recorridas: El Itinerario Completo' : 'Visited Cities: The Complete Itinerary')) ?></h1>

            <div class="map-container" id="cities-map"></div>

            <?php if (!empty($page_content['body'])): ?>
            <div class="journey-content">
                <?= $page_content['body'] ?>
            </div>
            <?php endif; ?>
        </section>
    </main>

    <?php include __DIR__ . '/../components/footer.php'; ?>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
    <script>
        var mapLang = '<?= $lang ?>';
        var mapChapterPrefix = '<?= $lang === 'es' ? 'capitulos' : 'chapters' ?>';
        var mapBasePath = '<?= BASE_PATH ?>';
        var mapViewChapter = '<?= $strings['view_chapter'] ?? 'View chapter' ?>';
    </script>
    <script src="<?= BASE_PATH ?>/js/map.js"></script>
    <script src="<?= BASE_PATH ?>/js/main.js"></script>
</body>
</html>
