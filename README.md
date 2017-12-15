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
git clone https://github.com/cardoso010/api-comentarios
```
Acessar o diretorio e atualizar o composer
```
cd api-comentarios/
sudo composer update
```

Criando arquivo .env
```
cp .env.example .env 
```

Alterando os seguintes campos com seu acesso ao banco de dados
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
php artisan key:generate
```

Apos configurar o banco, gerando os dados fictícios
```
php artisan db:seed
```

Executando projeto
```
php artisan serve
```

## Rotas

| Route                                      | HTTP     |
| ------------------------------------------ | -------- |
| /api/comentarios/                          | **POST** |
| /api/postagens/{postagem_id}/comentarios/  | **GET**  |
| /api/usuarios/{usuario_id}/notificacoes/   | **GET**  |


## Authors

* **Gabriel Cardoso Luiz** - *Initial work* - [cardoso010](https://github.com/cardoso010)




