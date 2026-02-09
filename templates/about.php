<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <?php include __DIR__ . '/../components/head.php'; ?>
</head>
<body class="page-about">
    <?php include __DIR__ . '/../components/header.php'; ?>

    <main class="main-content">
        <section class="about-page">
            <h1><?= htmlspecialchars($page_content['h1'] ?? ($lang === 'es' ? 'Nosotros' : 'About Us')) ?></h1>

            <?php if (!empty($page_content['members'])): ?>
            <div class="team-grid">
                <?php foreach ($page_content['members'] as $member): ?>
                <article class="team-member">
                    <div class="team-member-photo">
                        <?php if (!empty($member['photo'])): ?>
                        <img src="<?= BASE_PATH ?>/img/<?= $member['photo'] ?>"
                             alt="<?= htmlspecialchars(($member['first_name'] ?? '') . ' ' . ($member['last_name'] ?? '')) ?>"
                             loading="lazy">
                        <?php endif; ?>
                    </div>
                    <div class="team-member-info">
                        <?php if (!empty($member['join_note'])): ?>
                        <p class="team-member-join"><?= htmlspecialchars($member['join_note']) ?></p>
                        <?php endif; ?>
                        <h2><?= htmlspecialchars($member['first_name'] ?? '') ?></h2>
                        <h3><?= htmlspecialchars($member['last_name'] ?? '') ?></h3>
                        <p><?= htmlspecialchars($member['bio'] ?? '') ?></p>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </section>
    </main>

    <?php include __DIR__ . '/../components/footer.php'; ?>
    <script src="<?= BASE_PATH ?>/js/main.js"></script>
</body>
</html>
