<?php
/**
 * Expreso a Oriente - Site Configuration
 */

define('SITE_NAME', 'Expreso a Oriente');
define('SITE_EMAIL', 'info@expresoaoriente.com');
define('SITE_URL', 'https://expresoaoriente.com');
define('DEFAULT_LANG', 'es');
define('SUPPORTED_LANGS', serialize(['es', 'en']));

// Social media URLs
$social = [
    'facebook'  => 'https://www.facebook.com/ExpresoAOriente',
    'twitter'   => 'https://twitter.com/expresoaoriente',
    'vimeo'     => 'https://vimeo.com/expresoaoriente',
    'youtube'   => 'https://www.youtube.com/expresoaoriente',
    'instagram' => ''
];

// Base path (empty for root, or '/subfolder' if installed in a subdirectory)
define('BASE_PATH', '');
