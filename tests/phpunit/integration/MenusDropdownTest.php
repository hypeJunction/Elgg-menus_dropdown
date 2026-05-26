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
        $plugin = \elgg_get_plugin_from_id('menus_dropdown');
        $this->assertNotNull($plugin, 'Plugin menus_dropdown should be loadable');
    }

    public function testJsViewExists(): void {
        $this->assertTrue(
            \elgg_view_exists('elements/navigation/dropdown.js'),
            'JS view elements/navigation/dropdown.js should exist'
        );
    }

    public function testCssViewExists(): void {
        $this->assertTrue(
            \elgg_view_exists('elements/navigation/dropdown.css'),
            'CSS view elements/navigation/dropdown.css should exist'
        );
    }
}
