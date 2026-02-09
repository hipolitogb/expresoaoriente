<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <?php include __DIR__ . '/../components/head.php'; ?>
</head>
<body class="page-journey">
    <?php include __DIR__ . '/../components/header.php'; ?>

    <main class="main-content">
        <section class="journey-page">
            <h1><?= htmlspecialchars($page_content['h1'] ?? ($lang === 'es' ? 'El Viaje' : 'The Journey')) ?></h1>

            <div class="journey-content">
                <?= $page_content['body'] ?? '' ?>
            </div>
        </section>
    </main>

    <?php include __DIR__ . '/../components/footer.php'; ?>
    <script src="<?= BASE_PATH ?>/js/main.js"></script>
</body>
</html>
