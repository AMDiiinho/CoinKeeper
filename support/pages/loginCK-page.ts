import { Page } from '@playwright/test'

const loginCK = async (page:Page) => {

  await page.goto('http://localhost:8000/home');
  await page.getByRole('link', { name: 'Entrar' }).click();
  await page.getByRole('textbox', { name: 'Digite seu e-mail' }).click();
  await page.getByRole('textbox', { name: 'Digite seu e-mail' }).fill('arthur.abcm@gmail.com');
  await page.getByRole('textbox', { name: 'Digite sua senha' }).click();
  await page.getByRole('textbox', { name: 'Digite sua senha' }).fill('123456');
  await page.getByRole('button', { name: 'Entrar' }).click();
  await page.waitForTimeout(5000);

};

export {
    loginCK
}