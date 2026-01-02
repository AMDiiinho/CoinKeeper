# 💰 CoinKeeper

Aplicativo web para **controle de finanças pessoais**, permitindo o cadastro e organização de transações financeiras com categorias, subcategorias e suporte a lançamentos recorrentes.

O projeto foi desenvolvido com **Laravel (Blade)** no backend e **HTML, CSS e JavaScript** no frontend, focando em organização financeira simples e uma interface clara.

---

## 📌 Visão Geral

O **CoinKeeper** ajuda a organizar entradas e saídas de dinheiro, permitindo:

- Agrupamento por categorias e subcategorias
- Uso de ícones e cores para melhor visualização
- Registro de lançamentos recorrentes
- Interface com modal dinâmico para criação de transações

A aplicação utiliza componentes Blade reutilizáveis e validações tanto no frontend quanto no backend.

---

## ✨ Funcionalidades

- Cadastro de transações com:
  - Título
  - Tipo (entrada ou saída)
  - Status
  - Data
  - Valor
- Gerenciamento de categorias e subcategorias com:
  - Ícones
  - Cores personalizadas
- Lançamentos recorrentes com:
  - Definição de período
  - Quantidade de repetições
- Modal de criação de transações com:
  - Validação de campos
  - Comportamento dinâmico via JavaScript
- Layout responsivo
- Ajustes visuais para evitar redimensionamento indesejado de campos

---

## 🛠 Tecnologias Utilizadas

- **Backend:** PHP com Laravel
- **Views:** Blade Templates
- **Frontend:** HTML, CSS e JavaScript
- **Build tools:** Vite / npm
- **Banco de dados:** MySQL ou PostgreSQL (configurável via `.env`)

---

## ✅ Requisitos Locais

Antes de iniciar, certifique-se de ter instalado:

- PHP **8.x**
- Composer
- Node.js e npm
- Banco de dados (MySQL ou PostgreSQL)

---

## 🚀 Instalação

### 1. Clone o repositório

```bash
git clone https://github.com/AMDiinho/CoinKeeper.git
cd CoinKeeper
```


### 2. Clone o repositório

```bash
composer install
npm install
```


### 3. Configure o ambiente

```bash
cp .env.example .env
```

- Edite o arquivo .env e configure as credenciais do banco de dados.

- Em seguida, gere a chave da aplicação:

```bash
php artisan key:generate
```

### 4. Rode as migrations e seeders

```bash
php artisan migrate --seed
```

### 5. Compile os assets para desenvolvimento

```bash
npm run dev
```

### 6. Inicie o servidor local

```bash
php artisan serve
```

▶️ Uso

- Acesse a aplicação pelo endereço exibido no terminal (geralmente http://127.0.0.1:8000)

- Utilize o modal Nova Transação para cadastrar entradas e saídas

- Crie categorias e subcategorias com ícones e cores para facilitar a organização

- Verifique as validações do formulário antes de salvar os dados

📂 Estrutura do Projeto

```bash
app/                # Models, Controllers e lógica da aplicação
routes/             # Definição das rotas web
resources/views/    # Templates Blade, componentes e modais
resources/js/       # Scripts frontend
resources/css/      # Estilos e ajustes de layout
public/             # Assets públicos (CSS e JS compilados, imagens)
database/           # Migrations e seeders
```
