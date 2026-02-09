<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <?php include __DIR__ . '/../components/head.php'; ?>
</head>
<body class="page-404">
    <?php include __DIR__ . '/../components/header.php'; ?>

    <main class="main-content">
        <div class="container">
            <section class="error-page">
                <h1><?= $strings['page_not_found'] ?? 'Page not found' ?></h1>
                <p><?= $strings['page_not_found_text'] ?? '' ?></p>
                <a href="<?= BASE_PATH ?>/<?= $lang ?>/" class="btn"><?= $strings['back_home'] ?? 'Back to home' ?></a>
            </section>
        </div>
    </main>

    <?php include __DIR__ . '/../components/footer.php'; ?>
    <script src="<?= BASE_PATH ?>/js/main.js"></script>
</body>
</html>
