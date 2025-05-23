# ✅ To-Do List - Mini ERP com CodeIgniter 3 + Docker

## 🚀 Planejamento Inicial

- [X] Ler todas as instruções do teste
- [X] Criar repositório GitHub público
- [X] Clonar CodeIgniter 3 (https://codeigniter.com/)
- [X] Adicionar estrutura MVC inicial (controllers, models, views)
- [X] Adicionar Bootstrap ao projeto
- [ ] Analisar e documentar requisitos:
  - [ ] Levantar casos de uso (ex.: cadastro, atualização, fluxo de compra, aplicação de cupons, verificação CEP, envio de e-mail e webhook)
  - [ ] Esboçar fluxogramas e diagramas ER do banco de dados

---

## 🐳 Docker e Ambiente

- [ ] Criar `Dockerfile` para app PHP (CodeIgniter)
- [ ] Criar `docker-compose.yml` com:
  - [ ] Serviço `app` com Apache + PHP 7.x
  - [ ] Serviço `db` com MySQL 5.7 ou MySQL 8
- [ ] Montar volumes:
  - [ ] Código -> `/var/www/html`
  - [ ] Persistência dos dados do MySQL
- [ ] Configurar `.env` (se desejar separar as configurações)
- [ ] Testar acesso ao projeto via `http://localhost:8080`
- [ ] Documentar as configurações de ambiente e containers

---

## 🔧 Banco de Dados e Migrations

- [X] Criar script SQL com as seguintes tabelas:
  - [X] `produtos`
  - [X] `estoques` *(equivalente a “estoque” definido no requisito)*
  - [X] `cupons`
  - [X] `pedidos`
- [X] Adicionar esse script SQL em `/database/schema.sql`
- [ ] (Opcional) Integrar ferramenta de migrations externa (ex.: Phinx)
- [ ] (Opcional) Automatizar a importação do SQL no container do banco
- [ ] Criar diagramas ER/documentação do modelo de dados

---

## 📦 CRUD de Produtos e Estoque

- [X] Controller: `Produtos.php`
- [X] Model: `Produto_model.php`
- [X] Views:
  - [X] `produtos/index.php`
  - [X] `produtos/form.php`
- [ ] Lógica:
  - [X] Cadastro de produtos com nome, preço, variações e estoque*O cadastro deve gerar a associação entre as tabelas `produtos` e `estoques`*
  - [X] Implementar update dos dados do produto e do estoque na mesma tela
  - [X] Relacionar `produtos` ↔ `estoques`
  - [X] (Bônus) Permitir cadastro de variações com controle de estoque específico
- [ ] Testar criação, vinculação e atualização de registros

---

## 🛒 Carrinho de Compras

- [X] Controller: `Carrinho.php`
- [X] Model: `Pedido_model.php`
- [ ] Na tela do produto, incluir botão **Comprar** que:
  - [X] Adicione o produto ao carrinho armazenado na sessão
  - [ ] Gerencie controle de estoque e valores do pedido (incluindo decremento no estoque)
- [ ] Lógica do carrinho:
  - [X] Calcular o subtotal dos produtos do carrinho
  - [ ] Aplicar regras de frete:
    - [X] Frete de R$15,00 para subtotais entre R$52,00 e R$166,59
    - [X] Frete grátis para subtotais acima de R$200,00
    - [ ] Frete de R$20,00 para os demais casos
- [ ] Finalizar o pedido:
  - [ ] Gravar o pedido na tabela `pedidos`, com os produtos (em formato serializado, por exemplo, JSON)
  - [ ] Atualizar o estoque conforme itens vendidos

---

## 🌎 Verificação de CEP com ViaCEP

- [ ] Implementar AJAX para consulta ao endpoint do ViaCEP (https://viacep.com.br/)
- [ ] Buscar e preencher automaticamente os dados do endereço no formulário do pedido
- [ ] Validar e tratar erros na consulta do CEP

---

## 🎟️ Cupons (Bônus)

- [ ] CRUD de cupons:
  - [ ] Criar interface (ou utilizar migrações) para cadastro, atualização e exclusão de cupons
- [ ] Validação de cupons:
  - [ ] Verificar a validade (data de expiração) e o valor mínimo do cupom em relação ao subtotal do carrinho
- [ ] Aplicar desconto do cupom no cálculo do carrinho
- [ ] Testar diferentes cenários e validações de cupons

---

## ✉️ Envio de E-mail (Bônus)

- [ ] Configurar a CI Email Library do CodeIgniter
- [ ] Desenvolver template de e-mail com o resumo do pedido (itens, subtotal, frete, total e endereço)
- [ ] Integrar e disparar o envio de e-mail ao finalizar o pedido
- [ ] Testar envio e formatar corretamente as informações do e-mail

---

## 🔗 Webhook de Status (Bônus)

- [ ] Criar endpoint `Pedidos/webhook_status`
- [ ] Programar o endpoint para receber os parâmetros `id` e `status` do pedido
- [ ] Se o status recebido for "cancelado":
  - [ ] Remover o pedido ou reverter a atualização do estoque
- [ ] Se o status for diferente:
  - [ ] Atualizar o status do pedido no banco de dados
- [ ] Implementar medidas de segurança (autenticação, tokens) para o endpoint

---

## 🧪 Testes e Ajustes

- [ ] Testar todos os fluxos da aplicação:
  - [ ] Cadastro e update de produtos/estoque
  - [ ] Fluxo de compra e gerenciamento do carrinho (incluindo regras de frete)
  - [ ] Consulta de CEP com ViaCEP
  - [ ] Uso e aplicação de cupons
  - [ ] Envio de e-mail de confirmação de pedido
  - [ ] Recebimento e tratamento do webhook
- [ ] Tratar exceções (ex.: falha na consulta de CEP, problemas no envio de e-mail, inconsistências no estoque)
- [ ] Validar a consistência dos dados (pedido, estoque, etc.)
- [ ] Realizar testes funcionais e de integração

---

## ✅ Finalização

- [ ] Criar README com:
  - [ ] Tecnologias utilizadas
  - [ ] Instruções para rodar o projeto com Docker
  - [ ] Diagrama e/ou descrição da estrutura do banco de dados
  - [ ] Instruções para configuração do ambiente e deploy
- [X] Adicionar script SQL no repositório
- [ ] Subir o projeto completo no GitHub
- [ ] Inserir o link do repositório público no formulário de entrega
- [ ] Revisar documentação e realizar code review para limpeza do código antes da entrega
