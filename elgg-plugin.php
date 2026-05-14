<?php

return [
	'plugin' => [
		'id' => 'menus_dropdown',
		'name' => 'Dropdown Menus',
		'version' => '7.0.0',
		'description' => 'Dropdown navigation menus for Elgg.',
		'author' => 'Ismayil Khayredinov',
		'category' => 'ui',
	],

	'bootstrap' => \hypeJunction\MenusDropdown\Bootstrap::class,

	'view_extensions' => [
		'elements/navigation.css' => [
			'elements/navigation/dropdown.css' => [],
		],
		'admin.css' => [
			'elements/navigation/dropdown.css' => [],
		],
	],

];
