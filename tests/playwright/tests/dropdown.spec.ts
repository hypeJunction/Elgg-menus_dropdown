import { test, expect } from '@playwright/test';

test.describe('menus_dropdown plugin', () => {

  test('dropdown CSS loaded', async ({ page }) => {
    await page.goto('/');

    // Verify the dropdown CSS rules are present in the page
    const hasDropdownStyle = await page.evaluate(() => {
      for (const sheet of document.styleSheets) {
        try {
          for (const rule of sheet.cssRules) {
            if (rule.cssText && rule.cssText.includes('.elgg-child-menu')) {
              return true;
            }
          }
        } catch {
          // Cross-origin stylesheets will throw; skip them
        }
      }
      return false;
    });

    expect(hasDropdownStyle).toBe(true);
  });

  test('dropdown JS handler binds on click', async ({ page }) => {
    await page.goto('/');

    // Wait for jQuery/AMD to initialize
    await page.waitForFunction(() => typeof (window as any).jQuery !== 'undefined', { timeout: 10_000 });

    // Inject a synthetic dropdown item — the plugin provides CSS/JS behavior but
    // does not create menu items; a fresh install has none with this class.
    await page.evaluate(() => {
      const ul = document.querySelector('.elgg-menu-site') || document.querySelector('nav ul') || document.body;
      const li = document.createElement('li');
      li.className = 'elgg-menu-item-has-dropdown';
      li.innerHTML = `<a href="javascript:void(0);" id="test-dropdown-trigger">Test</a><ul class="elgg-menu elgg-child-menu" id="test-dropdown-menu" style="display:none"><li><a href="#">Item</a></li></ul>`;
      ul.appendChild(li);
    });

    // Give AMD require time to load the dropdown module
    await page.waitForTimeout(2000);

    const trigger = page.locator('#test-dropdown-trigger');
    await expect(trigger).toBeVisible({ timeout: 5_000 });

    await trigger.click();

    // JS adds elgg-menu-hover class to the child menu before calling popup.open().
    // This confirms the event handler bound and executed.
    const childMenu = page.locator('#test-dropdown-menu');
    await expect(childMenu).toHaveClass(/elgg-menu-hover/, { timeout: 5_000 });
  });

  test('dropdown CSS hides child menus by default', async ({ page }) => {
    await page.goto('/');

    // Inject a menu item with a child menu and verify CSS hides it
    await page.evaluate(() => {
      const ul = document.querySelector('.elgg-menu-site') || document.querySelector('nav ul') || document.body;
      const li = document.createElement('li');
      li.className = 'elgg-menu-item-has-dropdown';
      li.innerHTML = `<a href="javascript:void(0);">Test2</a><ul class="elgg-menu elgg-child-menu" id="test-child-menu2"><li><a href="#">Item</a></li></ul>`;
      ul.appendChild(li);
    });

    const childMenu = page.locator('#test-child-menu2');
    await expect(childMenu).toBeHidden();
  });

});
