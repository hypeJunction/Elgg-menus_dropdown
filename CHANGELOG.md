<a name="7.0.0"></a>
## 7.0.0 (2026-05-09)

### Elgg 7.x migration

* `composer.json` bumped to `elgg/elgg ~7.0.0`, `php >=8.3`.
* Docker test stack added for Elgg 7.x (docker/elgg7/).
* No PHP or CSS breaking changes. No data migration required.

<a name="6.0.0"></a>
## 6.0.0 (2026-05-09)

### Elgg 6.x migration

* `composer.json` bumped to `elgg/elgg ~6.1.0`, `php >=8.1`, added `ext-intl`.
* `dropdown.js` converted from AMD (`require([...], function(){...})`) to ES module (`import $ from 'jquery'; import popup from 'elgg/popup';`).
* Docker test stack added for Elgg 6.x (docker/elgg6/).
* No data migration required.

<a name="3.0.0"></a>
## 3.0.0 (2026-04-20)

### Elgg 5.x migration

* Migrated plugin to Elgg 5.x. Target PHP >= 8.1.
* `composer.json` bumped to `elgg/elgg ^5.0` and `php >=8.1`.
* Docker infra updated: PHP 8.1-apache, Elgg ~5.1.0, MySQL 8.0.
* `dropdown.js`: removed explicit `jquery-ui` AMD require — `elgg/popup` already
  depends on the modularized `jquery-ui/position` in Elgg 5.x; declaring the
  bundled `jquery-ui` module caused a 403 and prevented the handler from loading.
* No PHP changes needed — plugin has no PHP logic.
* All 3 PHPUnit integration tests pass on Elgg 5.x.
* All 3 Playwright E2E tests pass on Elgg 5.x.

<a name="2.0.0"></a>
# [2.0.0](https://github.com/hypeJunction/Elgg-menus_dropdown/compare/1.0.2...v2.0.0) (2017-02-23)


### Bug Fixes

* **js:** correct positioning and multiple click events ([78edaf9](https://github.com/hypeJunction/Elgg-menus_dropdown/commit/78edaf9))
* **js:** fix dropdown menu positioning ([5bc5cb2](https://github.com/hypeJunction/Elgg-menus_dropdown/commit/5bc5cb2))
* **js:** fix dropdown menu positioning ([cff677a](https://github.com/hypeJunction/Elgg-menus_dropdown/commit/cff677a))

### Features

* **deps:** drop ui_popup requirement ([3cbcba6](https://github.com/hypeJunction/Elgg-menus_dropdown/commit/3cbcba6))


### BREAKING CHANGES

* deps: Now requires Elgg 2.3



<a name="1.0.2"></a>
## [1.0.2](https://github.com/hypeJunction/Elgg-menus_dropdown/compare/1.0.1...v1.0.2) (2016-01-27)


### Bug Fixes

* **css:** fix borders of nested menu items ([bce27a3](https://github.com/hypeJunction/Elgg-menus_dropdown/commit/bce27a3))



<a name="1.0.1"></a>
## [1.0.1](https://github.com/hypeJunction/Elgg-menus_dropdown/compare/1.0.0...v1.0.1) (2016-01-27)


### Bug Fixes

* **css:** fix selector ([fed69f1](https://github.com/hypeJunction/Elgg-menus_dropdown/commit/fed69f1))



<a name="1.0.0"></a>
# 1.0.0 (2016-01-27)


### Features

* **releases:** initial commit ([b4af91d](https://github.com/hypeJunction/Elgg-menus_dropdown/commit/b4af91d))



