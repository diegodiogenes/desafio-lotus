# Rotas

Foram criados um total de 18 rotas, sendo elas:
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

----------

## Auth
- Prefixo: `auth`

**Login**:
`[POST] /auth/login`

- **Body**

| Campo | Tipo | Obrigatório | Especificações |
| ----- | ---- | ----------- | -------------- |
| `email` | string | Sim | E-mail válido e máximo de 255 caracteres, deve existir em `users`. |
| `password` | string | Sim | Mínimo de 8 e máximo de 255 caracteres. |

Exemplo de request:
```json
{
  "email": "admin@admin.com",
  "password": "password"
}
```

Exemplo de response:
```json
{
  "data": {
    "token": {
      "access": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZGJhMjUzMGY3ZWE2OWQwNjFiZWVlNWM4NDA3ODIyNjg4ZjE2NDkxMTE2OTViMTZkNmFiNzZkMjg4ZjcyMTdkMzYzNDMwY2FiNTQ5OTlhYmQiLCJpYXQiOjE2MDEyMzMwNzMsIm5iZiI6MTYwMTIzMzA3MywiZXhwIjoxNjAxMzE5NDcyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.YA-ZD7cjkh7kZQTXFcanyDq0Ru-ApFiYx_kVHQcT6LXti8AQUJ2o7OV4sEvotJy1HoOoNTF9uClYCGRzLKBzJpJwGv9K63pO0xidNktAo2ALvWjFVL5rkl79wJRCXq1-BFbcPeYyIbBLXckkbx67GyUtKtILhHJ1v8MBD2KouPhQ1vEL1zLCo-wo3dkWuesZIgHitggj7ZmXZ5THTKZrM-Vhqah1X6uCL5sJmSJQkII8JBm4SfKqt55JH9tofA423OM5rr4CSbmMBHyWRXVucYe16FS_7C9pqhyAJyG9zCvvg6iwQt4F3v58NKnRQ9OX2CHhPZuuMO4ShhoJrfhAv9FNxrx3NrYAaqyUSVJ5kE8lOqUHTThOJirnAckU9UURvZXV8OPI5V14dXEPNCx1Jx2APSQoMSqFPi9JjSS7Lcc-WrsfICynAQwwaN_u7pkJhpc_EbXobYtc44dRh1iJKcy8auVnXsI3LJewMQRgs6V1aku11r6c1MG3KuQ8SizoGx7wrbtKyEr-J19E8HnYmG-cBmDGAbj20mUgyz0jthNqFbtRr_DyPDJQRFD0QIlDdC10FOuzPxQvnY2YbrrUptjHSgJveDcOZZwaK_Kr7C7mH_hN3RSkgC1UjiOgSg-y11JORzS5mHFHVfQOBDMBSIjvTM_NK9J_PHy-cqBUALo",
      "expires": "2020-09-28 18:57:52"
    },
    "user": {
      "id": 1,
      "name": "Admin",
      "email": "admin@admin.com",
      "created_at": null,
      "updated_at": null
    }
  }
}
```

**Logout**:
`[GET] /auth/logout`

- **Validação**:
  - Deve existir sessão.

Exemplo de response:
```json
{
  "message": "Hasta la vista!"
}
```

----------

## Users

**Listar**:
`[GET] /users`

- **Validação**:
  - Deve existir sessão.

Exemplo de response:

`/users?q=Admin`
```json
{
  "data": [
    {
      "id": 1,
      "name": "Admin",
      "email": "admin@admin.com"
    }
  ],
  "links": {
    "first": "http:\/\/0.0.0.0:8010\/api\/users?page=1",
    "last": "http:\/\/0.0.0.0:8010\/api\/users?page=1",
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 1,
    "links": [
      {
        "url": null,
        "label": "Previous",
        "active": false
      },
      {
        "url": "http:\/\/0.0.0.0:8010\/api\/users?page=1",
        "label": 1,
        "active": true
      },
      {
        "url": null,
        "label": "Next",
        "active": false
      }
    ],
    "path": "http:\/\/0.0.0.0:8010\/api\/users",
    "per_page": 15,
    "to": 1,
    "total": 1
  }
}
```

`/users`
```json
{
  "data": [
    {
      "id": 1,
      "name": "Admin",
      "email": "admin@admin.com"
    },
    {
      "id": 2,
      "name": "Laron Medhurst",
      "email": "elfrieda11@example.org"
    },
    {
      "id": 3,
      "name": "Mrs. Libby Smitham V",
      "email": "ttoy@example.com"
    },
    {
      "id": 4,
      "name": "Miss Burnice Muller Sr.",
      "email": "awehner@example.net"
    }
  ],
  "links": {
    "first": "http:\/\/0.0.0.0:8010\/api\/users?page=1",
    "last": "http:\/\/0.0.0.0:8010\/api\/users?page=1",
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 1,
    "links": [
      {
        "url": null,
        "label": "Previous",
        "active": false
      },
      {
        "url": "http:\/\/0.0.0.0:8010\/api\/users?page=1",
        "label": 1,
        "active": true
      },
      {
        "url": null,
        "label": "Next",
        "active": false
      }
    ],
    "path": "http:\/\/0.0.0.0:8010\/api\/users",
    "per_page": 15,
    "to": 4,
    "total": 4
  }
}
```

**Registrar**:
`[POST] /users`

- **Body**

| Campo | Tipo | Obrigatório | Especificações |
| ----- | ---- | ----------- | -------------- |
| `name` | string | Sim | Mínimo de 3 e máximo de 255 caracteres. |
| `email` | string | Sim | E-mail válido e máximo de 255 caracteres, deve ser único nos `users`. |
| `password` | string | Sim | Mínimo de 8 e máximo de 255 caracteres, possui campo de confirmação (`password_confirmation`) com mesmo valor. |

Exemplo de request:
```json
{
  "name": "Diego Diogenes",
  "email": "diegodiogenes@mail.com",
  "password": "diegodiogenes",
  "password_confirmation": "diegodiogenes"
}
```

Exemplo de response:
```json
{
  "message": "User registered successfully!",
  "data": {
    "user": {
      "name": "Diego Diogenes",
      "email": "diegodiogenes@mail.com",
      "updated_at": "2020-09-27T20:01:38.000000Z",
      "created_at": "2020-09-27T20:01:38.000000Z",
      "id": 6
    }
  }
}
```

**Visualizar**:
`[GET] /users/{user}`

- **Validação**:
  - Deve existir sessão.

Exemplo de response:
```json
{
  "data": {
    "id": 1,
    "name": "Admin",
    "email": "admin@admin.com"
  }
}
```

**Atualizar**:
`[PUT] /users/{user}`

- **Validação**:
  - Deve existir sessão;
  - Ser o próprio usuário.

- **Body**

| Campo | Tipo | Obrigatório | Especificações |
| ----- | ---- | ----------- | -------------- |
| `name` | string | Não | Mínimo de 3 e máximo de 255 caracteres. |
| `email` | string | Não | E-mail válido e máximo de 255 caracteres, deve ser único nos `users`. |
| `password` | string | Não | Mínimo de 8 e máximo de 255 caracteres, possui campo de confirmação (`password_confirmation`) com mesmo valor. |

Exemplo de request:
```json
{
	"name": "Diego Diego"
}
```

Exemplo de response:
```json
{
  "message": "User updated successfully!",
  "data": {
    "id": 1,
    "name": "Diego Diego",
    "email": "admin@admin.com",
    "created_at": null,
    "updated_at": "2020-09-27T19:56:19.000000Z"
  }
}
```

**Apagar**:
`[DELETE] /users/{user}`

- **Validação**:
  - Deve existir sessão;
  - Ser o usuário responsável pelos conta atualizada.

Exemplo de response:
```json
{
  "message": "User successfully deleted!"
}
```

----------

## Products

**Relatório**:
`[GET] /products/report`

- **Validação**:
  - Deve existir sessão;

- **Parametros**

| Campo | Tipo | Obrigatório | Especificações |
| ----- | ---- | ----------- | -------------- |
| `to` | date | Não | Data no formato d/m/y. |
| `from` | date | Não | Data no formato d/m/y. |
| `order` | string | Não | Um dos valores: [asc, desc]. |

Exemplo de chamada:

`[GET] /products/report?to=10/10/2020&from=10/09/2020`

Exemplo de response:
```json
{
  "data": [
    {
      "id": 12,
      "description": "Miss Alfreda O'Hara",
      "code": "1756704",
      "sales_count": 1
    },
    {
      "id": 13,
      "description": "Unique Sipes V",
      "code": "5439694",
      "sales_count": 1
    },
    {
      "id": 11,
      "description": "Allene DuBuque",
      "code": "1139419",
      "sales_count": 1
    }
  ]
}
```

**Listar**:
`[GET] /products`

- **Validação**:
  - Deve existir sessão.

Exemplo de response:
```json
{
  "data": [
    {
      "id": 1,
      "description": "Lessie Durgan",
      "code": "3817836",
      "image": null,
      "price": "R$ 55,80",
      "sale_price": "R$ 54,09",
      "available": 1
    },
    {
      "id": 2,
      "description": "Dr. Ben Hahn V",
      "code": "6944291",
      "image": null,
      "price": "R$ 130,48",
      "sale_price": "R$ 52,24",
      "available": 1
    },
    {
      "id": 3,
      "description": "Derrick Gusikowski PhD",
      "code": "1243249",
      "image": null,
      "price": "R$ 82,11",
      "sale_price": "R$ 67,55",
      "available": 1
    },
    {
      "id": 4,
      "description": "Frederic Mills",
      "code": "9404384",
      "image": null,
      "price": "R$ 78,63",
      "sale_price": "R$ 52,92",
      "available": 1
    },
    {
      "id": 5,
      "description": "Emilie Ryan",
      "code": "9631766",
      "image": null,
      "price": "R$ 60,30",
      "sale_price": "R$ 60,93",
      "available": 1
    },
    {
      "id": 6,
      "description": "Devonte Carroll",
      "code": "2431681",
      "image": null,
      "price": "R$ 19,36",
      "sale_price": "R$ 0,27",
      "available": 1
    },
    {
      "id": 7,
      "description": "Mr. Haleigh Keebler",
      "code": "0431255",
      "image": null,
      "price": "R$ 77,10",
      "sale_price": "R$ 55,56",
      "available": 1
    },
    {
      "id": 8,
      "description": "Juana Becker",
      "code": "8426326",
      "image": null,
      "price": "R$ 62,96",
      "sale_price": "R$ 7,73",
      "available": 1
    },
    {
      "id": 9,
      "description": "Murphy Kunze",
      "code": "4707869",
      "image": null,
      "price": "R$ 22,12",
      "sale_price": "R$ 32,89",
      "available": 1
    },
    {
      "id": 10,
      "description": "Cathy Murphy",
      "code": "4640777",
      "image": null,
      "price": "R$ 82,04",
      "sale_price": "R$ 7,38",
      "available": 1
    },
    {
      "id": 11,
      "description": "Allene DuBuque",
      "code": "1139419",
      "image": null,
      "price": "R$ 69,92",
      "sale_price": "R$ 56,62",
      "available": 1
    },
    {
      "id": 12,
      "description": "Miss Alfreda O'Hara",
      "code": "1756704",
      "image": null,
      "price": "R$ 30,02",
      "sale_price": "R$ 77,28",
      "available": 1
    },
    {
      "id": 13,
      "description": "Unique Sipes V",
      "code": "5439694",
      "image": null,
      "price": "R$ 20,79",
      "sale_price": "R$ 42,79",
      "available": 1
    },
    {
      "id": 14,
      "description": "Feijão",
      "code": "12345678",
      "image": null,
      "price": "R$ 5,60",
      "sale_price": "R$ 8,20",
      "available": 1
    }
  ],
  "links": {
    "first": "http:\/\/0.0.0.0:8010\/api\/products?page=1",
    "last": "http:\/\/0.0.0.0:8010\/api\/products?page=1",
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 1,
    "links": [
      {
        "url": null,
        "label": "Previous",
        "active": false
      },
      {
        "url": "http:\/\/0.0.0.0:8010\/api\/products?page=1",
        "label": 1,
        "active": true
      },
      {
        "url": null,
        "label": "Next",
        "active": false
      }
    ],
    "path": "http:\/\/0.0.0.0:8010\/api\/products",
    "per_page": 15,
    "to": 14,
    "total": 14
  }
}
```

**Registrar**:
`[POST] /products`

- **Validação**:
  - Deve existir sessão.

- **Body**

| Campo | Tipo | Obrigatório | Especificações |
| ----- | ---- | ----------- | -------------- |
| `description` | string | Sim | Máximo de 255 caracteres. |
| `code` | string | Sim | Tamanho de 8 caracteres. |
| `price` | decimal | Sim | Tamanho de 6 digitos. |
| `sale_price` | decimal | Sim | Tamanho de 6 digitos. |
| `image` | file | Não | Imagem. |
| `available` | boolean | Não | Tamanho de 1 caractere. Default True |

Exemplo de request:
```json
{
  "description": "Feijão",
  "price": "5.60",
  "sale_price": "8.20",
  "code": "12345678",
  "available": "1"
}
```

Exemplo de response:
```json
{
  "message": "Product registered successfully!",
  "data": {
    "product": {
      "id": 14,
      "description": "Feijão",
      "code": "12345678",
      "image": null,
      "price": "R$ 5,60",
      "sale_price": "R$ 8,20",
      "available": "1"
    }
  }
}
```

**Visualizar**:
`[GET] /products/{product}`

- **Validação**:
  - Deve existir sessão.

Exemplo de response:
```json
{
  "data": {
    "id": 2,
    "description": "Dr. Ben Hahn V",
    "code": "6944291",
    "image": null,
    "price": "R$ 21,88",
    "sale_price": "R$ 52,24",
    "available": 1
  }
}
```

**Atualizar**:
`[PUT] /products/{product}`

- **Validação**:
  - Deve existir sessão;

- **Body**

| Campo | Tipo | Obrigatório | Especificações |
| ----- | ---- | ----------- | -------------- |
| `description` | string | Não | Máximo de 255 caracteres. |
| `code` | string | Não | Tamanho de 8 caracteres. |
| `price` | decimal | Não | Tamanho de 6 digitos. |
| `sale_price` | decimal | Não | Tamanho de 6 digitos. |
| `image` | file | Não | Imagem. |
| `available` | boolean | Não | Tamanho de 1 caractere. Default True |

Exemplo de request:
```json
{
  "price": "130.48"
}
```

Exemplo de response:
```json
{
  "message": "Product updated successfully!",
  "data": {
    "id": 2,
    "description": "Dr. Ben Hahn V",
    "code": "6944291",
    "image": null,
    "price": "R$ 130,48",
    "sale_price": "R$ 52,24",
    "available": 1
  }
}
```

**Apagar**:
`[DELETE] /accounts/{account}`

- **Validação**:
  - Deve existir sessão;

Exemplo de response:
```json
{
  "message": "Product successfully deleted!"
}
```

----------

## Sales

**Listar**:
`[GET] /sales`

- **Validação**:
  - Deve existir sessão.

Exemplo de response:
```json
{
  "data": [
    {
      "amount": "R$ 176,69",
      "profit": "R$ 55,96",
      "products": [
        {
          "id": 11,
          "description": "Allene DuBuque",
          "code": "1139419",
          "image": null,
          "price": "R$ 69,92",
          "sale_price": "R$ 56,62",
          "available": 1
        },
        {
          "id": 12,
          "description": "Miss Alfreda O'Hara",
          "code": "1756704",
          "image": null,
          "price": "R$ 30,02",
          "sale_price": "R$ 77,28",
          "available": 1
        },
        {
          "id": 13,
          "description": "Unique Sipes V",
          "code": "5439694",
          "image": null,
          "price": "R$ 20,79",
          "sale_price": "R$ 42,79",
          "available": 1
        }
      ]
    }
  ],
  "links": {
    "first": "http:\/\/0.0.0.0:8010\/api\/sales?page=1",
    "last": "http:\/\/0.0.0.0:8010\/api\/sales?page=1",
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 1,
    "links": [
      {
        "url": null,
        "label": "Previous",
        "active": false
      },
      {
        "url": "http:\/\/0.0.0.0:8010\/api\/sales?page=1",
        "label": 1,
        "active": true
      },
      {
        "url": null,
        "label": "Next",
        "active": false
      }
    ],
    "path": "http:\/\/0.0.0.0:8010\/api\/sales",
    "per_page": 15,
    "to": 1,
    "total": 1
  }
}
```

**Registrar**:
`[POST] /products`

- **Validação**:
  - Deve existir sessão.

- **Body**

| Campo | Tipo | Obrigatório | Especificações |
| ----- | ---- | ----------- | -------------- |
| `products` | array | Sim | Id dos produtos que existam no sistema. |

Exemplo de request:
```json
{
  "products": [5, 6, 7, 8]
}
```

Exemplo de response:
```json
{
  "message": "Sale registered successfully!",
  "data": {
    "product": {
      "amount": "R$ 124,49",
      "profit": "R$ -95,23",
      "products": [
        {
          "id": 5,
          "description": "Emilie Ryan",
          "code": "9631766",
          "image": null,
          "price": "R$ 60,30",
          "sale_price": "R$ 60,93",
          "available": 1
        },
        {
          "id": 6,
          "description": "Devonte Carroll",
          "code": "2431681",
          "image": null,
          "price": "R$ 19,36",
          "sale_price": "R$ 0,27",
          "available": 1
        },
        {
          "id": 7,
          "description": "Mr. Haleigh Keebler",
          "code": "0431255",
          "image": null,
          "price": "R$ 77,10",
          "sale_price": "R$ 55,56",
          "available": 1
        },
        {
          "id": 8,
          "description": "Juana Becker",
          "code": "8426326",
          "image": null,
          "price": "R$ 62,96",
          "sale_price": "R$ 7,73",
          "available": 1
        }
      ]
    }
  }
}
```

**Visualizar**:
`[GET] /sales/{sale}`

- **Validação**:
  - Deve existir sessão.

Exemplo de response:
```json
{
  "data": {
    "amount": "R$ 124,49",
    "profit": "R$ -95,23",
    "products": [
      {
        "id": 5,
        "description": "Emilie Ryan",
        "code": "9631766",
        "image": null,
        "price": "R$ 60,30",
        "sale_price": "R$ 60,93",
        "available": 1
      },
      {
        "id": 6,
        "description": "Devonte Carroll",
        "code": "2431681",
        "image": null,
        "price": "R$ 19,36",
        "sale_price": "R$ 0,27",
        "available": 1
      },
      {
        "id": 7,
        "description": "Mr. Haleigh Keebler",
        "code": "0431255",
        "image": null,
        "price": "R$ 77,10",
        "sale_price": "R$ 55,56",
        "available": 1
      },
      {
        "id": 8,
        "description": "Juana Becker",
        "code": "8426326",
        "image": null,
        "price": "R$ 62,96",
        "sale_price": "R$ 7,73",
        "available": 1
      }
    ]
  }
}
```

**Atualizar**:
`[PUT] /sales/{sale}`

- **Validação**:
  - Deve existir sessão;

- **Body**

| Campo | Tipo | Obrigatório | Especificações |
| ----- | ---- | ----------- | -------------- |
| `products` | array | Não | Id dos produtos que existam no sistema. |
| `amount` | decimal | Não | Tamanho de 6 dígitos. |
| `profit` | decimal | Não | Tamanho de 6 digitos. |

Exemplo de request:
```json
{
  "amount": "130.48"
}
```

Exemplo de response:
```json
{
  "message": "Sale updated successfully!",
  "data": {
    "amount": "R$ 180,00",
    "profit": "R$ -95,23",
    "products": [
      {
        "id": 5,
        "description": "Emilie Ryan",
        "code": "9631766",
        "image": null,
        "price": "R$ 60,30",
        "sale_price": "R$ 60,93",
        "available": 1
      },
      {
        "id": 6,
        "description": "Devonte Carroll",
        "code": "2431681",
        "image": null,
        "price": "R$ 19,36",
        "sale_price": "R$ 0,27",
        "available": 1
      },
      {
        "id": 7,
        "description": "Mr. Haleigh Keebler",
        "code": "0431255",
        "image": null,
        "price": "R$ 77,10",
        "sale_price": "R$ 55,56",
        "available": 1
      },
      {
        "id": 8,
        "description": "Juana Becker",
        "code": "8426326",
        "image": null,
        "price": "R$ 62,96",
        "sale_price": "R$ 7,73",
        "available": 1
      }
    ]
  }
}
```

**Apagar**:
`[DELETE] /accounts/{account}`

- **Validação**:
  - Deve existir sessão;

Exemplo de response:
```json
{
  "message": "Sale successfully deleted!"
}
```
