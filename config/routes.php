<?php
/**
 * Expreso a Oriente - Route Definitions
 * Maps URL patterns to templates and content.
 */

$routes = [
    'es' => [
        ''                    => ['template' => 'home',    'page' => null],
        'nosotros'            => ['template' => 'about',   'page' => 'about'],
        'el-viaje'            => ['template' => 'journey', 'page' => 'journey'],
        'ciudades-recorridas' => ['template' => 'cities',  'page' => 'cities'],
        'contacto'            => ['template' => 'contact', 'page' => 'contact'],
        'contacto/enviar'     => ['template' => 'contact-send', 'page' => null],
        'capitulos/*'         => ['template' => 'chapter', 'page' => null], // * = slug
    ],
    'en' => [
        ''                    => ['template' => 'home',    'page' => null],
        'about-us'            => ['template' => 'about',   'page' => 'about'],
        'the-journey'         => ['template' => 'journey', 'page' => 'journey'],
        'visited-cities'      => ['template' => 'cities',  'page' => 'cities'],
        'contact'             => ['template' => 'contact', 'page' => 'contact'],
        'contact/send'        => ['template' => 'contact-send', 'page' => null],
        'chapters/*'          => ['template' => 'chapter', 'page' => null], // * = slug
    ]
];

/**
 * Resolve a URL path to a route
 * Returns: ['template' => string, 'lang' => string, 'page' => string|null, 'chapter_slug' => string|null]
 */
function resolve_route($path) {
    global $routes;

    // Clean the path
    $path = trim($path, '/');
    $path = preg_replace('#^' . preg_quote(trim(BASE_PATH, '/'), '#') . '/?#', '', $path);
    $path = trim($path, '/');

    // Detect language from first segment
    $segments = explode('/', $path, 3);
    $lang = DEFAULT_LANG;

    if (in_array($segments[0], unserialize(SUPPORTED_LANGS))) {
        $lang = $segments[0];
        $path = isset($segments[1]) ? implode('/', array_slice($segments, 1)) : '';
    } else {
        // No language prefix → redirect to default
        return ['redirect' => '/' . DEFAULT_LANG . '/' . $path];
    }

    $lang_routes = $routes[$lang];

    // Exact match
    if (isset($lang_routes[$path])) {
        return array_merge($lang_routes[$path], [
            'lang' => $lang,
            'chapter_slug' => null
        ]);
    }

    // Wildcard match (chapters)
    $chapter_prefixes = $lang === 'es' ? 'capitulos' : 'chapters';
    if (strpos($path, $chapter_prefixes . '/') === 0) {
        $slug = substr($path, strlen($chapter_prefixes) + 1);
        if ($slug) {
            return [
                'template'     => 'chapter',
                'lang'         => $lang,
                'page'         => null,
                'chapter_slug' => $slug
            ];
        }
    }

    // 404
    return ['template' => '404', 'lang' => $lang, 'page' => null, 'chapter_slug' => null];
}
