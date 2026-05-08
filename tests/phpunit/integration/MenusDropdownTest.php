<?php

namespace HypeJunction\MenusDropdown;

use Elgg\IntegrationTestCase;

class MenusDropdownTest extends IntegrationTestCase {

	public function up() {}
	public function down() {}

	public function getPluginID(): string {
		return 'menus_dropdown';
	}

	public function testPluginLoads(): void {
		$plugin = elgg_get_plugin_from_id('menus_dropdown');
		$this->assertNotNull($plugin, 'Plugin menus_dropdown should be loadable');
	}

	public function testPluginIsEnabled(): void {
		$plugin = elgg_get_plugin_from_id('menus_dropdown');
		$this->assertNotNull($plugin);
		$this->assertTrue($plugin->isEnabled(), 'Plugin menus_dropdown should be enabled');
	}

	public function testPluginIsActive(): void {
		$plugin = elgg_get_plugin_from_id('menus_dropdown');
		$this->assertNotNull($plugin);
		$this->assertTrue($plugin->isActive(), 'Plugin menus_dropdown should be active');
	}

	public function testDropdownCssViewExists(): void {
		$this->assertTrue(
			elgg_view_exists('elements/navigation/dropdown.css'),
			'CSS view elements/navigation/dropdown.css should exist'
		);
	}

	public function testDropdownJsViewExists(): void {
		$this->assertTrue(
			elgg_view_exists('elements/navigation/dropdown.js'),
			'JS view elements/navigation/dropdown.js should exist'
		);
	}

	public function testNavigationCssExtendsDropdownCss(): void {
		$viewList = array_values(_elgg_services()->views->getViewList('elements/navigation.css'));
		$this->assertContains(
			'elements/navigation/dropdown.css',
			$viewList,
			'elements/navigation.css should be extended with dropdown.css'
		);
	}

	public function testAdminCssExtendsDropdownCss(): void {
		$viewList = array_values(_elgg_services()->views->getViewList('admin.css'));
		$this->assertContains(
			'elements/navigation/dropdown.css',
			$viewList,
			'admin.css should be extended with dropdown.css'
		);
	}

	public function testElggJsExtendsDropdownJs(): void {
		$viewList = array_values(_elgg_services()->views->getViewList('elgg.js'));
		$this->assertContains(
			'elements/navigation/dropdown.js',
			$viewList,
			'elgg.js should be extended with dropdown.js'
		);
	}
}
