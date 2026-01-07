# Gatil Arca d’Água  
Projeto de Laboratório de Programação

## Descrição

Este projeto consiste no desenvolvimento de uma aplicação web para o **Gatil Arca d’Água**, uma associação dedicada ao resgate, cuidado e adoção responsável de gatos.

A aplicação foi desenvolvida no âmbito da unidade curricular **Laboratório de Programação**, com foco na construção de uma base sólida em **Laravel**, separação clara entre frontend e backend, e preparação para integração futura com base de dados.

Atualmente, o projeto inclui:
- Estrutura visual completa (frontend)
- Autenticação de utilizadores (login e registo)
- Páginas informativas funcionais
- Layout preparado para dados dinâmicos
- Serviços Externos / API - SMTP e Stripe

---

## Tecnologias Utilizadas

- **PHP >= 8.1**
- **Laravel**
- **Composer**
- **Node.js + npm**
- **Vite**
- **Blade (templates)**
- **CSS personalizado**
- **SMTP (Mailtrap - ambiente de testes)**
- **Stripe API (pagamentos em modo teste)**

---
## Serviços Externos / API 

### Envio de Emails (SMTP) 

Esta funcionalidade é utilizada na página de Voluntariado, permitindo que os pedidos submetidos pelos utilizadores sejam enviados por email para a associação.

Características:

- Comunicação externa via servidor SMTP

- Utilização do sistema de emails nativo do Laravel (Mailable)

- Ambiente de teste seguro (emails não são enviados para destinatários reais)

- Permite validar o fluxo completo de envio de mensagens


## Doações Monetárias (Stripe)

Foi integrada a plataforma Stripe para simular doações monetárias através do Stripe Checkout, em modo de teste.

Na página de Doações, o utilizador pode selecionar valores predefinidos e é redirecionado para a página oficial de pagamento da Stripe.
Após a simulação do pagamento, o utilizador regressa à aplicação com uma confirmação de sucesso ou cancelamento.

Características:

- Integração com API externa de pagamentos

- Utilização do Stripe Checkout (página hosted)

- Pagamentos simulados (cartões de teste)

- Fluxo completo: aplicação → Stripe → aplicação

## Estrutura do Projeto

- `resources/views/`  
  Contém os templates Blade organizados por páginas e parciais.

- `resources/css/app.css`  
  Ficheiro CSS global, organizado por componentes (navbar, hero, cards, auth, etc.), sem dependência de frameworks externos.

- `public/img/`  
  Imagens utilizadas no site (logos e imagens ilustrativas).

O frontend foi desenvolvido de forma reutilizável, permitindo a futura ligação a uma base de dados sem necessidade de alterações estruturais no layout ou no CSS.

---

## Instalação

1. Clonar o repositório:
   ```bash
   git clone https://github.com/DiogoOliveira04ufp/projeto_lab_programacao
   cd projeto_lab_programacao
   ```

2. Instalar dependências PHP: 
   ```bash 
   composer install
   ```

3. Instalar dependências JavaScript:
   ```bash
   npm install 
   ```

4. Criar ficheiro de ambiente:
   ```bash 
   cp .env.example .env
   ```

5. Gerar a chave da aplicação:
   ```bash
   php artisan key:generate
   ```

## Compilação dos Assets

Compilar os ficheiros CSS e JavaScript com Vite:
```bash 
npm run dev 
```
## Execução do Projeto

Iniciar o servidor de desenvolvimento:
```bash 
php artisan serve 
```
Aceder no browser:
```bash 
http://127.0.0.1:8000
```


   