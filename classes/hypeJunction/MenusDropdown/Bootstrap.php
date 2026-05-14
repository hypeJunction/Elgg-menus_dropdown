<?php

namespace hypeJunction\MenusDropdown;

use Elgg\DefaultPluginBootstrap;

/**
 * Plugin bootstrap.
 */
class Bootstrap extends DefaultPluginBootstrap {

	/**
	 * {@inheritdoc}
	 */
	public function init() {
		elgg_import_esm('elements/navigation/dropdown');
	}
}
