<?php

/**
 * Test bootstrap for menus_dropdown plugin.
 *
 * Requires Elgg's autoloader to be available via Composer.
 */

$autoloader = dirname(__DIR__) . '/vendor/autoload.php';
if (!file_exists($autoloader)) {
    $autoloader = dirname(__DIR__, 4) . '/vendor/autoload.php';
}

if (file_exists($autoloader)) {
    require_once $autoloader;
}
