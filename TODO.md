# ✅ To-Do List - Mini ERP com CodeIgniter 3 + Docker

## 🚀 Planejamento Inicial

- [X] Ler todas as instruções do teste
- [X] Criar repositório GitHub público
- [X] Clonar CodeIgniter 3 (https://codeigniter.com/)
- [X] Adicionar estrutura MVC inicial (controllers, models, views)
- [X] Adicionar Bootstrap ao projeto

---

## 🐳 Docker e Ambiente

- [ ] Criar `Dockerfile` para app PHP (CodeIgniter)
- [ ] Criar `docker-compose.yml` com:
  - [ ] Serviço `app` com Apache + PHP 7.x
  - [ ] Serviço `db` com MySQL 5.7 ou 8
- [ ] Montar volumes:
  - [ ] Código -> `/var/www/html`
  - [ ] Persistência de dados MySQL
- [ ] Configurar `.env` (se desejar separar config)
- [ ] Testar acesso ao projeto via `http://localhost:8080`

---

## 🔧 Banco de Dados e Migrations

- [X] Criar script SQL com as seguintes tabelas:
  - [X] `produtos`
  - [X] `estoques`
  - [X] `cupons`
  - [X] `pedidos`
- [X] Adicionar esse `.sql` em `/database/schema.sql`
- [ ] (Opcional) Integrar ferramenta de migrations externa (Phinx)
- [ ] (Opcional) Automatizar import SQL no container de banco

---

## 📦 CRUD de Produtos e Estoque

- [X] Controller: `Produtos.php`
- [X] Model: `Produto_model.php`
- [ ] Views:
  - [X] `produtos/index.php`
  - [X] `produtos/form.php`
- [ ] Lógica:
  - [X] Cadastro com nome, preço, variações, estoque
  - [ ] Update de produto e estoque
  - [X] Relacionar `produtos` ↔ `estoques`

---

## 🛒 Carrinho de Compras

- [ ] Controller: `Carrinho.php`
- [ ] Model: `Pedido_model.php`
- [ ] Armazenar carrinho na sessão
- [ ] Adicionar produto ao carrinho
- [ ] Calcular subtotal + regras de frete
- [ ] Finalizar pedido no banco

---

## 🌎 Verificação de CEP

- [ ] Criar AJAX com integração ViaCEP
- [ ] Buscar e preencher endereço

---

## 🎟️ Cupons (Bônus)

- [ ] CRUD de cupons
- [ ] Validação de validade e valor mínimo
- [ ] Aplicar desconto no carrinho

---

## ✉️ Envio de E-mail (Bônus)

- [ ] Configurar CI Email Library
- [ ] Enviar e-mail com resumo do pedido

---

## 🔗 Webhook de Status (Bônus)

- [ ] Endpoint `Pedidos/webhook_status`
- [ ] Receber `id` + `status`
- [ ] Apagar ou atualizar pedido

---

## 🧪 Testes e Ajustes

- [ ] Testar todos os fluxos
- [ ] Tratar exceções
- [ ] Validar consistência de dados

---

## ✅ Finalização

- [ ] Criar README com:
  - [ ] Tecnologias
  - [ ] Rodando com Docker
  - [ ] Estrutura do banco
- [X] Adicionar script SQL no repositório
- [ ] Subir tudo no GitHub
- [ ] Enviar link do repositório público
