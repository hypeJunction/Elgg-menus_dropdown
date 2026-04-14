# menus_dropdown — Architecture (Elgg 4.x)

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
