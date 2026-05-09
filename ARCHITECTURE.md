# menus_dropdown — Architecture (Elgg 7.x)

## Summary

menus_dropdown adds dropdown navigation menu styles to Elgg. It extends core
navigation CSS (`elements/navigation.css` and `admin.css`) with dropdown
styles and registers a JS module for dropdown interactions.

## Directory Structure

```
menus_dropdown/
├── views/default/
│   └── elements/navigation/
│       ├── dropdown.css     — Dropdown menu styles
│       └── dropdown.js      — Dropdown menu interactions (AMD)
├── tests/
│   ├── phpunit/integration/MenusDropdownTest.php
│   ├── bootstrap.php
│   └── phpunit.xml
├── composer.json
└── elgg-plugin.php
```

## View Extensions

| Extends | With |
|---------|------|
| `elements/navigation.css` | `elements/navigation/dropdown.css` |
| `admin.css` | `elements/navigation/dropdown.css` |
| `elgg.js` | `elements/navigation/dropdown.js` |

## Dependencies

None — leaf plugin. Extends Elgg core navigation views.

## Migration Notes (3.x → 4.x)

- `manifest.xml` removed; `composer.json` is now the sole metadata source.
- `elgg-plugin.php` received the `'plugin'` key.
- `php` constraint added (`>=7.4`); `elgg/elgg` constraint added (`^4.0`);
  `composer/installers` bumped to `^2.0`; `config.allow-plugins` added.
- PHPUnit tests require `ELGG_SETTINGS_FILE` env var to use the installed DB
  (avoids `c_i_` prefix mismatch from `BaseTestCase::getTestingConfig()`).
- System cache must be cleared after plugin activation for PHPUnit to find
  views on first run (cache pre-dates activation).

## Migration Notes (6.x → 7.x)

- `elgg/elgg ~7.0.0`, `php >=8.3` in `composer.json`.
- Docker test stack added for Elgg 7.x (docker/elgg7/) with PHP 8.3.
- No breaking changes: no CSS Crush syntax, no direct `ElggObject` instantiation, no removed Elgg APIs.
- No data migration needed.

## Migration Notes (5.x → 6.x)

- `elgg/elgg ~6.1.0`, `php >=8.1`, `ext-intl` added in `composer.json`.
- `dropdown.js` converted from AMD (`require(['jquery', 'elgg/popup'], function($, popup){...})`) to ES module (`import $ from 'jquery'; import popup from 'elgg/popup';`).
- Docker test stack added for Elgg 6.x (docker/elgg6/).
- No data migration needed.

## Seeding

No seeder required. This plugin owns no entity types, subtypes, or persistent relationship schemas — it is a pure UI/utility/admin plugin with no persisted entity surface of its own.

## Migration Notes (4.x → 5.x)

- `composer.json`: `elgg/elgg` bumped to `^5.0`; `php` bumped to `>=8.1`.
- `dropdown.js`: removed explicit `jquery-ui` from AMD `require()` array —
  Elgg 5.x split `jquery-ui` into individual modules (`jquery-ui/position`,
  `jquery-ui/unique-id`). `elgg/popup` already depends on these; the plugin
  does not need to declare `jquery-ui` separately.
- Docker stack upgraded: PHP 8.1-apache, MySQL 8.0, Elgg ~5.1.0.
- `docker/.env` `ELGG_SITE_URL` changed from `http://localhost:PORT/` to
  `http://elgg/` (internal Docker service name required for 5.x HOST check).
- `ELGG_DB_PREFIX=elgg_` added to service environment for PHPUnit (prevents
  `c_i_elgg_` prefix mismatch in `BaseTestCase::getTestingConfig()`).
- Playwright tests rewritten to inject synthetic `.elgg-menu-item-has-dropdown`
  items — the plugin provides behavior for menus configured elsewhere; a fresh
  install has no dropdown items by default.
