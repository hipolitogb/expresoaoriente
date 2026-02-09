<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <?php include __DIR__ . '/../components/head.php'; ?>
</head>
<body class="page-contact">
    <?php include __DIR__ . '/../components/header.php'; ?>

    <main class="main-content">
        <section class="contact-page">
            <h1><?= htmlspecialchars($page_content['h1'] ?? ($lang === 'es' ? 'Contacto' : 'Contact')) ?></h1>

            <div class="contact-layout">
                <div class="contact-form-wrapper">
                    <?php
                    // Show success/error messages
                    if (isset($_GET['sent']) && $_GET['sent'] === '1') {
                        echo '<div class="form-message form-message--success">' . ($strings['contact_success'] ?? 'Message sent!') . '</div>';
                    }
                    if (isset($_GET['error'])) {
                        $error_msg = $_GET['error'] === 'captcha'
                            ? ($strings['contact_captcha_error'] ?? 'Incorrect captcha.')
                            : ($strings['contact_error'] ?? 'Error sending message.');
                        echo '<div class="form-message form-message--error">' . htmlspecialchars($error_msg) . '</div>';
                    }

                    require_once __DIR__ . '/../components/captcha.php';
                    $captcha = captcha_generate();
                    $form_action = BASE_PATH . '/' . $lang . '/' . ($lang === 'es' ? 'contacto/enviar' : 'contact/send');
                    ?>

                    <form class="contact-form" method="POST" action="<?= $form_action ?>">
                        <input type="hidden" name="lang" value="<?= $lang ?>">
                        <input type="hidden" name="captcha_hash" value="<?= $captcha['answer_hash'] ?>">

                        <div class="form-group">
                            <label for="contact-name"><?= $strings['contact_name'] ?? 'Name' ?></label>
                            <input type="text" id="contact-name" name="name" required autocomplete="name">
                        </div>

                        <div class="form-group">
                            <label for="contact-email"><?= $strings['contact_email'] ?? 'Email' ?></label>
                            <input type="email" id="contact-email" name="email" required autocomplete="email">
                        </div>

                        <div class="form-group">
                            <label for="contact-message"><?= $strings['contact_message'] ?? 'Message' ?></label>
                            <textarea id="contact-message" name="message" required></textarea>
                        </div>

                        <!-- Honeypot -->
                        <div class="form-hp" aria-hidden="true">
                            <input type="text" name="website" tabindex="-1" autocomplete="off">
                        </div>

                        <!-- Math Captcha -->
                        <div class="form-captcha">
                            <label for="captcha-answer"><?= $strings['contact_captcha'] ?? 'Solve' ?>:</label>
                            <span><?= $captcha['question'] ?></span>
                            <input type="text" id="captcha-answer" name="captcha_answer" required autocomplete="off">
                        </div>

                        <button type="submit" class="btn"><?= $strings['contact_send'] ?? 'Send' ?></button>
                    </form>
                </div>

                <div class="contact-info">
                    <h3><?= $strings['contact_info'] ?? 'Contact info' ?></h3>
                    <?php if (!empty($page_content['email'])): ?>
                    <p><strong>Email:</strong> <a href="mailto:<?= $page_content['email'] ?>"><?= $page_content['email'] ?></a></p>
                    <?php else: ?>
                    <p><strong>Email:</strong> <a href="mailto:<?= SITE_EMAIL ?>"><?= SITE_EMAIL ?></a></p>
                    <?php endif; ?>

                    <?php global $social; ?>
                    <?php if (!empty($social['facebook'])): ?>
                    <p><strong>Facebook:</strong> <a href="<?= $social['facebook'] ?>" target="_blank" rel="noopener">Expreso a Oriente</a></p>
                    <?php endif; ?>
                    <?php if (!empty($social['twitter'])): ?>
                    <p><strong>Twitter:</strong> <a href="<?= $social['twitter'] ?>" target="_blank" rel="noopener">@expresoaoriente</a></p>
                    <?php endif; ?>
                    <?php if (!empty($social['vimeo'])): ?>
                    <p><strong>Vimeo:</strong> <a href="<?= $social['vimeo'] ?>" target="_blank" rel="noopener">expresoaoriente</a></p>
                    <?php endif; ?>

                    <?php if (!empty($page_content['body'])): ?>
                    <div style="margin-top: 2rem;">
                        <?= $page_content['body'] ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>

    <?php include __DIR__ . '/../components/footer.php'; ?>
    <script src="<?= BASE_PATH ?>/js/main.js"></script>
</body>
</html>
