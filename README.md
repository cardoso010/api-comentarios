# api-comentarios

Projeto desenvolvido para a realização de um desafio.

### Prerequisites

```
PHP7
COMPOSER
MYSQL
APACHE2 OR NGINX
```

## Getting Started

Clonar repositório
```
$git clone https://github.com/cardoso010/api-comentarios
```
Acessar o diretorio e atualizar o composer
```
$cd api-comentarios/
$sudo composer update
```

Criando arquivo .env
```
$cp .env.example .env 
```

Alterando os seguintes campos com seu acesso ao banco de dados.
**Na criação do banco foi utilizado a collation utf8mb4_unicode_ci**
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

Gerando nova key para o ambiente
```
$php artisan key:generate
```

Executar as migrations para criação do banco
```
$php artisan migrate
```

Apos configurar o banco, gerando os dados fictícios
```
$php artisan db:seed
```

Executando projeto
```
$php artisan serve
```

## Rotas

| Route                                      | HTTP     |
| ------------------------------------------ | -------- |
| /api/comentarios/                          | **POST** |
| /api/postagens/{postagem_id}/comentarios/  | **GET**  |
| /api/usuarios/{usuario_id}/notificacoes/   | **GET**  |


## Regras

Usando dados do **seed**

**/api/comentarios/**

Usuários assinantes
```
{
	"comentario": "usuário assinante comentando em um poste de um assinante",
	"usuario_id": 1,
	"postagem_id": 1
}
```

Usuário não é assinante e o dono do poste não é assinante
```
{
	"comentario": "usuário não assinante comentando em um poste de um não assinante",
	"usuario_id": 2,
	"postagem_id": 2
}
```

Como o usuário está comprando destaque ele pode ser inserir o comentario mesmo não sendo assinante
```
{
	"comentario": "usuário não assinante comentando em um poste de um não assinante, é pra inserir pois o usuario está comprando destaque",
	"usuario_id": 2,
	"postagem_id": 2,
	"comprando_destaque": true
}
```

**Não é possivel inserir mais que 5 comentarios em um intervalo de 10 segundos**


**/api/postagens/{postagem_id}/comentarios/**
Endpoint responsavel por listar todos os comentarios de uma determinada postagem.
- É listado em ordem cronológica
- Existe paginação (na listagem vai existir um campo chamado **next_page_url** exemplo: http://127.0.0.1:8000/api/postagens/1/comentarios?page=2)
- A consulta é guardada em cache para otimizar

**/api/usuarios/{usuario_id}/notificacoes/**

## Authors

* **Gabriel Cardoso Luiz** - *Initial work* - [cardoso010](https://github.com/cardoso010)




