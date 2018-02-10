### Students

Tests: [![Build Status](https://travis-ci.org/fernandobandeira/students.svg?branch=master)](https://travis-ci.org/fernandobandeira/students)

Style: [![StyleCI](https://styleci.io/repos/120347431/shield?branch=master)](https://styleci.io/repos/120347431)

Requerimentos: PHP 7.2

Instalação:

```
cp .env.example .env
composer install
php artisan key:generate
```
Configurar o banco:
```
nano .env

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=nomebanco
DB_USERNAME=usuario
DB_PASSWORD=senha
```

Subir as tabelas do sistema:
```
php artisan migrate
php artisan db:seed #dados de teste
```

Para iniciar o sistema:

```
php artisan serve
```
