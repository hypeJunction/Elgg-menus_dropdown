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

  test('dropdown menu opens on click', async ({ page }) => {
    await page.goto('/');

    const trigger = page.locator('.elgg-menu-item-has-dropdown > a').first();
    await expect(trigger).toBeVisible({ timeout: 10_000 });

    await trigger.click();

    const childMenu = page.locator('.elgg-menu-item-has-dropdown > .elgg-child-menu').first();
    await expect(childMenu).toBeVisible({ timeout: 5_000 });
  });

  test('dropdown menu closes on outside click', async ({ page }) => {
    await page.goto('/');

    const trigger = page.locator('.elgg-menu-item-has-dropdown > a').first();
    await expect(trigger).toBeVisible({ timeout: 10_000 });

    // Open the dropdown
    await trigger.click();
    const childMenu = page.locator('.elgg-menu-item-has-dropdown > .elgg-child-menu').first();
    await expect(childMenu).toBeVisible({ timeout: 5_000 });

    // Click outside to close
    await page.locator('body').click({ position: { x: 1, y: 1 } });
    await expect(childMenu).not.toBeVisible({ timeout: 5_000 });
  });

});
