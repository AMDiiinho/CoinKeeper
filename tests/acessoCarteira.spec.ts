import { test, expect, Page} from '@playwright/test'
import { loginCK } from '../support/pages/loginCK-page'


test('Acessar Minha Carteira', async ({ page }) => {

    await loginCK(page);
    await page.getByRole('link', { name: 'Minha Carteira' }).click();

});