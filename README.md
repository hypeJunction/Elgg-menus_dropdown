Dropdown Menus for Elgg
=======================
![Elgg 2.3](https://img.shields.io/badge/Elgg-2.3-orange.svg?style=flat-square)

## Features

* Turn any child menu into a dropdown by simply adding `elgg-menu-item-has-dropdown` to the parent item class


## Usage

To convert child menus to dropdown menus, simply add `elgg-menu-item-has-dropdown` class to your
menu item. Whenever a parent menu item is clicked, child menu will appear in a hover menu

```php
elgg_register_menu_item('entity', array(
	'name' => 'parent',
	'href' => '#',
	'text' => 'Parent item',
	'item_class' => 'elgg-menu-item-has-dropdown',
	'data-my' => 'right top',
	'data-at' => 'right bottom+5px',
	'data-collision' => 'fit fit',
));
elgg_register_menu_item('entity', array(
	'name' => 'child',
	'parent_name' => 'parent',
	'href' => '/child',
	'text' => 'Child item',
));
```