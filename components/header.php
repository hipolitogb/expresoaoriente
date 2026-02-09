<?php
$nav_items = [
    'es' => [
        ['label' => 'Nosotros',            'url' => BASE_PATH . '/es/nosotros'],
        ['label' => 'El Viaje',            'url' => BASE_PATH . '/es/el-viaje'],
        ['label' => 'Ciudades Recorridas', 'url' => BASE_PATH . '/es/ciudades-recorridas'],
        ['label' => 'Contacto',            'url' => BASE_PATH . '/es/contacto'],
    ],
    'en' => [
        ['label' => 'About Us',        'url' => BASE_PATH . '/en/about-us'],
        ['label' => 'The Journey',     'url' => BASE_PATH . '/en/the-journey'],
        ['label' => 'Visited Cities',  'url' => BASE_PATH . '/en/visited-cities'],
        ['label' => 'Contact',         'url' => BASE_PATH . '/en/contact'],
    ]
];

$current_nav = $nav_items[$lang] ?? $nav_items['es'];
$lang_switch_label = $lang === 'es' ? 'English Version' : 'Versión Español';
$tagline = $lang === 'es'
    ? 'Tres personas que coinciden en la aventura de viajar ocho meses por el mundo y contar lo que la coincidencia les depara.'
    : 'Three people who coincide in the adventure of travelling eight months around the world and tell what the coincidence would provide them.';
?>

<header class="site-header" id="site-header">
    <div class="header-inner">
        <a class="header-logo" href="<?= BASE_PATH ?>/<?= $lang ?>/" title="<?= SITE_NAME ?>" aria-label="<?= SITE_NAME ?> - Home">
            <span class="logo-mark"><?= SITE_NAME ?></span>
        </a>

        <p class="header-tagline"><?= $tagline ?></p>

        <button class="menu-toggle" id="menu-toggle" aria-label="<?= $strings['menu'] ?? 'Menu' ?>" aria-expanded="false">
            <span class="menu-bar"></span>
            <span class="menu-bar"></span>
            <span class="menu-bar"></span>
        </button>

        <nav class="main-nav" id="main-nav" aria-label="<?= $strings['main_navigation'] ?? 'Main navigation' ?>">
            <ul class="nav-list">
                <?php foreach ($current_nav as $item): ?>
                <li class="nav-item">
                    <a href="<?= $item['url'] ?>" class="nav-link"><?= $item['label'] ?></a>
                </li>
                <?php endforeach; ?>
            </ul>
        </nav>

        <a class="lang-switch" href="<?= $alt_url ?>" title="<?= $lang_switch_label ?>">
            <?= $lang_switch_label ?>
        </a>
    </div>
</header>
