<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<title><?= htmlspecialchars($seo['title']) ?></title>
<meta name="description" content="<?= htmlspecialchars($seo['description']) ?>">

<!-- Canonical & Hreflang -->
<link rel="canonical" href="<?= SITE_URL . $_SERVER['REQUEST_URI'] ?>">
<link rel="alternate" hreflang="<?= $lang ?>" href="<?= SITE_URL . $_SERVER['REQUEST_URI'] ?>">
<link rel="alternate" hreflang="<?= $alt_lang ?>" href="<?= SITE_URL . $alt_url ?>">

<!-- Open Graph -->
<meta property="og:title" content="<?= htmlspecialchars($seo['title']) ?>">
<meta property="og:description" content="<?= htmlspecialchars($seo['description']) ?>">
<meta property="og:type" content="<?= $template === 'chapter' ? 'article' : 'website' ?>">
<meta property="og:url" content="<?= SITE_URL . $_SERVER['REQUEST_URI'] ?>">
<meta property="og:site_name" content="<?= SITE_NAME ?>">
<?php if (!empty($seo['og_image'])): ?>
<meta property="og:image" content="<?= SITE_URL . BASE_PATH . '/img/' . $seo['og_image'] ?>">
<?php endif; ?>

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@expresoaoriente">
<meta name="twitter:title" content="<?= htmlspecialchars($seo['title']) ?>">
<meta name="twitter:description" content="<?= htmlspecialchars($seo['description']) ?>">

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&family=DM+Serif+Display&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

<!-- Styles -->
<link rel="stylesheet" href="<?= BASE_PATH ?>/css/style.css">

<!-- Favicon -->
<link rel="icon" type="image/png" href="<?= BASE_PATH ?>/img/favicon.png">
