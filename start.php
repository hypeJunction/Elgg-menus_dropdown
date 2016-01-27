<?php

/**
 * Dropdown Menu
 *
 * @author Ismayil Khayredinov <info@hypejunction.com>
 * @copyright Copyright (c) 2015, Ismayil Khayredinov
 */
require_once __DIR__ . '/autoloader.php';

elgg_register_event_handler('init', 'system', 'menus_dropdown_init');

/**
 * Initialize the plugin
 * @return void
 */
function menus_dropdown_init() {

	elgg_extend_view('elements/navigation.css', 'elements/navigation/dropdown.css');
	elgg_extend_view('admin.css', 'elements/navigation/dropdown.css');
	
	elgg_extend_view('elgg.js', 'elements/navigation/dropdown.js');
}
