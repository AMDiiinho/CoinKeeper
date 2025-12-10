import { test, expect, Page } from '@playwright/test';
import { loginCK } from '../support/pages/loginCK-page';

test('Cadastrar Cartao Credito', async ({page}) => {

    await loginCK(page);
    await page.getByRole('link', { name: 'Minha Carteira' }).click();
    await page.locator('#abreModal').click();
    await page.getByRole('textbox', { name: 'Digite um apelido para o cart' }).click();
    await page.getByRole('textbox', { name: 'Digite um apelido para o cart' }).fill('Cadastro cartão crédito');
    await page.locator('#campoBanco').selectOption('elo');
    await page.locator('#tipoCartao').selectOption('credito');
    await page.getByRole('textbox', { name: 'Digite o limite do cartão' }).click();
    await page.getByRole('textbox', { name: 'Digite o limite do cartão' }).fill('3000');
    await page.getByPlaceholder('Informe a data de fechamento').click();
    await page.getByPlaceholder('Informe a data de fechamento').fill('4');
    await page.getByPlaceholder('Informe a data de vencimento').click();
    await page.getByPlaceholder('Informe a data de vencimento').fill('8');
    await page.getByRole('textbox', { name: 'Informe o saldo do cartão' }).click();
    await page.getByRole('textbox', { name: 'Informe o saldo do cartão' }).fill('20000');
    await page.getByRole('button', { name: 'Salvar Cartão' }).click();

});