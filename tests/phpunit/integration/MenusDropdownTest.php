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

	public function testDropdownEsmModuleExists(): void {
		$this->assertTrue(
			elgg_view_exists('elements/navigation/dropdown.mjs'),
			'ESM module view elements/navigation/dropdown.mjs should exist'
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

	public function testDropdownEsmModuleResolves(): void {
		// The module is loaded via elgg_import_esm('elements/navigation/dropdown')
		// in the plugin bootstrap; Elgg resolves the extensionless name to the
		// elements/navigation/dropdown.mjs view in the importmap.
		$this->assertNotEmpty(
			elgg_view('elements/navigation/dropdown.mjs'),
			'ESM module elements/navigation/dropdown.mjs should render non-empty source'
		);
	}

	/**
	 * Regression for 359273e: dropdown.js was renamed to dropdown.mjs so that
	 * elgg_import_esm('elements/navigation/dropdown') resolves via the Elgg 7
	 * importmap (which never registers .js views). The .mjs twin existing is
	 * asserted above; here we guard the other half — the legacy .js view must be
	 * gone, otherwise the ESM-wrong-extension regression is silently back.
	 */
	public function testLegacyDropdownJsViewRemoved(): void {
		$this->assertFalse(
			elgg_view_exists('elements/navigation/dropdown.js'),
			'Legacy elements/navigation/dropdown.js view must not exist after the .js -> .mjs rename'
		);
	}

	/**
	 * Regression for 60923bc: the stale
	 * 'elgg.js' => ['elements/navigation/dropdown.js'] view_extension was removed
	 * from elgg-plugin.php — the module now loads via the importmap
	 * (elgg_import_esm in Bootstrap::init()), not as an elgg.js extension. The
	 * elgg.js view list must therefore carry neither the old .js nor the new .mjs
	 * dropdown view.
	 */
	public function testElggJsNotExtendedWithDropdown(): void {
		$viewList = array_values(_elgg_services()->views->getViewList('elgg.js'));
		$this->assertNotContains(
			'elements/navigation/dropdown.js',
			$viewList,
			'elgg.js must not be extended with the legacy dropdown.js view'
		);
		$this->assertNotContains(
			'elements/navigation/dropdown.mjs',
			$viewList,
			'elgg.js must not carry the dropdown module — it loads via the importmap, not a view extension'
		);
	}

	/**
	 * Regression for 60923bc: the plugin gained a Bootstrap whose init() calls
	 * elgg_import_esm('elements/navigation/dropdown'). elgg-plugin.php must
	 * declare that Bootstrap and it must extend Elgg\DefaultPluginBootstrap
	 * (otherwise init() never fires and the module is never imported).
	 */
	public function testBootstrapClassDeclaredAndExtendsDefault(): void {
		$manifest = include dirname(__DIR__, 3) . '/elgg-plugin.php';
		$this->assertSame(
			\hypeJunction\MenusDropdown\Bootstrap::class,
			$manifest['bootstrap'] ?? null,
			'elgg-plugin.php must declare \\hypeJunction\\MenusDropdown\\Bootstrap as the bootstrap class'
		);
		$this->assertTrue(
			is_subclass_of(\hypeJunction\MenusDropdown\Bootstrap::class, \Elgg\DefaultPluginBootstrap::class),
			'Bootstrap must extend Elgg\\DefaultPluginBootstrap'
		);
	}
}
