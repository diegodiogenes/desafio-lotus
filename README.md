# Resolução Lotus

Este projeto trata da solução para o desafio de Back-end da Lotus Experience, uma API para o controle de vendas e produtos de uma verdureira.

- Linguagem: [**PHP**](https://www.php.net/);
- Framework back-end: [**Laravel**](https://laravel.com/);
- Banco de dados: [**MySQL**](https://www.mysql.com/).

## Setup

Para iniciar o projeto, é necessário que tenha instalado em sua máquina o [Docker](https://docs.docker.com/engine/install/) e o [Docker Compose](https://docs.docker.com/compose/install/)

Tendo feito a instação anterior, basta rodar o seguinte comando na raiz do projeto:

```shell script
docker-compose up -d --build
```

Basta acessar agora: http://0.0.0.0:8010/

Você deverá ver a página inicial default do laravel.


### Realizando testes

Para testar se o setup foi concluído com êxito, utilize o comando:

```shell script
./bin/run_test.sh
```

### Criando as tabelas do sistema com as migrations

Para rodar as migrações do sistema basta rodar o comando:

```shell script
./bin/migrate.sh
```

### Dados iniciais do sistema

Para adicionar dados iniciais ao sistema, pode ser utilizado o seguinte comando:

```shell script
./bin/init_db.sh
```
Os dados criados podem ser acessados através dos seeds do projeto.

## Features do Sistema:

- Cadastro, Busca, Edição e Exclusao de Usuário.
- Cadastro, Busca, Edição e Exclusao de Produto.
- Pode ser cadastrado uma imagem ao produto.
- Cadastro, Busca, Edição e Exclusao de Vendas.
- Relatório por período de vendas, como os produtos mais vendidos e menos vendidos.

## Rotas

Foram criados um total de 11 rotas, sendo elas:
- Auth
  - Login: `[POST] /api/auth/login/`
  - Logout: `[GET] /api/auth/logout/`
- Usuários
  - Listar: `[GET] api/users`
  - Registrar: `[POST] api/users`
  - Atualizar: `[PUT] api/users/:id`
  - Ver: `[PUT] api/users/:id`
  - Apagar: `[DELETE] api/users/:id`
- Produtos
  - Listar: `[GET] api/products`
  - Registrar: `[POST] api/products`
  - Atualizar: `[PUT] api/products/:id`
  - Ver: `[PUT] api/products/:id`
  - Apagar: `[DELETE] api/products/:id`
  - Relatório: `[GET] api/products/report/`
- Vendas
  - Listar: `[GET] api/sales`
  - Registrar: `[POST] api/sales`
  - Atualizar: `[PUT] api/sales/:id`
  - Ver: `[PUT] api/sales/:id`
  - Apagar: `[DELETE] api/sales/:id`
