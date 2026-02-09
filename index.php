<?php
/**
 * Expreso a Oriente - Main Router
 * All requests pass through here via .htaccess rewrite.
 */

// Load configuration
require_once __DIR__ . '/config/site.php';
require_once __DIR__ . '/config/chapters.php';
require_once __DIR__ . '/config/routes.php';

// Resolve the current route
$request_uri = $_SERVER['REQUEST_URI'];
$path = parse_url($request_uri, PHP_URL_PATH);
$route = resolve_route($path);

// Handle redirect (no lang prefix)
if (isset($route['redirect'])) {
    header('Location: ' . $route['redirect'], true, 301);
    exit;
}

$lang = $route['lang'];
$template = $route['template'];

// Load UI strings for the current language
$strings_file = __DIR__ . '/content/' . $lang . '/strings.json';
$strings = file_exists($strings_file) ? json_decode(file_get_contents($strings_file), true) : [];

// Load page content if applicable
$page_content = null;
if ($route['page']) {
    $page_file = __DIR__ . '/content/' . $lang . '/pages/' . $route['page'] . '.json';
    if (file_exists($page_file)) {
        $page_content = json_decode(file_get_contents($page_file), true);
    }
}

// Load chapter content if applicable
$chapter = null;
$chapter_content = null;
$chapter_index = null;
$prev_chapter = null;
$next_chapter = null;

if ($template === 'chapter' && $route['chapter_slug']) {
    $chapter = find_chapter_by_slug($route['chapter_slug'], $lang);
    if ($chapter) {
        $chapter_index = $chapter['_index'];
        $json_key = 'json_' . $lang;
        $chapter_file = __DIR__ . '/content/' . $lang . '/chapters/' . $chapter[$json_key] . '.json';
        if (file_exists($chapter_file)) {
            $chapter_content = json_decode(file_get_contents($chapter_file), true);
        }
        $prev_chapter = get_prev_chapter($chapter_index);
        $next_chapter = get_next_chapter($chapter_index);
    } else {
        $template = '404';
    }
}

// Determine the alternate language URL for hreflang
$alt_lang = $lang === 'es' ? 'en' : 'es';
$alt_url = build_alt_url($route, $alt_lang);

// SEO meta data
$seo = get_seo_data($template, $lang, $page_content, $chapter_content);

// Render the template
if ($template === '404') {
    http_response_code(404);
}

$template_file = __DIR__ . '/templates/' . $template . '.php';
if (file_exists($template_file)) {
    include $template_file;
} else {
    http_response_code(404);
    include __DIR__ . '/templates/404.php';
}

/**
 * Build the alternate language URL
 */
function build_alt_url($route, $alt_lang) {
    global $routes;

    if ($route['template'] === 'chapter' && $route['chapter_slug']) {
        $chapter = find_chapter_by_slug($route['chapter_slug'], $route['lang']);
        if ($chapter) {
            $alt_slug = $chapter['slug_' . $alt_lang];
            $prefix = $alt_lang === 'es' ? 'capitulos' : 'chapters';
            return BASE_PATH . '/' . $alt_lang . '/' . $prefix . '/' . $alt_slug;
        }
    }

    // For static pages, find the matching route key in the other language
    $template = $route['template'];
    $page = $route['page'];

    if ($template === 'home') {
        return BASE_PATH . '/' . $alt_lang . '/';
    }

    // Find the route key for this template in the alt language
    foreach ($routes[$alt_lang] as $path => $r) {
        if ($r['template'] === $template && strpos($path, '*') === false) {
            return BASE_PATH . '/' . $alt_lang . '/' . $path;
        }
    }

    return BASE_PATH . '/' . $alt_lang . '/';
}

/**
 * Get SEO metadata for the current page
 */
function get_seo_data($template, $lang, $page_content, $chapter_content) {
    $seo = [
        'title'       => SITE_NAME,
        'description' => '',
        'og_image'    => '',
        'canonical'   => '',
    ];

    if ($chapter_content) {
        $seo['title'] = $chapter_content['seo_title'] ?? SITE_NAME;
        $seo['description'] = $chapter_content['meta_description'] ?? '';
        $seo['og_image'] = $chapter_content['og_image'] ?? '';
    } elseif ($page_content) {
        $seo['title'] = $page_content['seo_title'] ?? SITE_NAME;
        $seo['description'] = $page_content['meta_description'] ?? '';
        $seo['og_image'] = $page_content['og_image'] ?? '';
    } else {
        // Default home/other
        $defaults = [
            'es' => [
                'title' => 'Expreso a Oriente | Viaje de 8 Meses por Europa, Asia y Medio Oriente',
                'description' => 'Tres personas que coinciden en la aventura de viajar ocho meses por el mundo y contar lo que la coincidencia les depara.'
            ],
            'en' => [
                'title' => 'Expreso a Oriente | An 8-Month Journey Through Europe, Asia and the Middle East',
                'description' => 'Three people who coincide in the adventure of travelling eight months around the world and tell what the coincidence would provide them.'
            ]
        ];
        $seo['title'] = $defaults[$lang]['title'] ?? SITE_NAME;
        $seo['description'] = $defaults[$lang]['description'] ?? '';
    }

    return $seo;
}
