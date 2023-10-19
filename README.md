## Sumário

:small_blue_diamond: [Requisitos](#requisitos)

:small_blue_diamond: [Execute projeto](#execute-projeto)

:small_blue_diamond: [Tecnologias utilizadas](#tecnologias-utilizadas)

:small_blue_diamond: [Licença](#licença)

## Pré-requisitos

:warning: [PHP:^8.1](https://www.php.net/releases/8.1/en.php)

:warning: [Composer](https://getcomposer.org/download/)

:warning: [MySQL](https://hub.docker.com/_/mysql)

## Execute projeto

Entre na pasta

```
cd plataforma-verde-api
```

Instale as dependências do composer:

```
composer install
```

Copie .env.example e preencha .env:

```
cp .env.example .env
```

Gerar a chave do projeto:

```
php artisan key:generate
```

Execute as migrations:

```
php artisan migrate
```

De permissão as pastas:

```
sudo chgrp -R www-data storage bootstrap/cache && sudo chmod -R ug+rwx storage bootstrap/cache
```

Execute o projeto no modo desenvolvimento

```
php artisan serve
```

## Tecnologias utilizadas

-   [PHP 8.1](https://www.php.net/)
-   [Laravel 9.x](https://laravel.com/docs/9.x)

## Licença

The [MIT License]() (MIT)

Copyright :copyright: 2022 - app-ce4b9bea
