# Products API

## Installation

1 - Clone this repository
```bash
git clone https://github.com/rleal-dev/api-products.git
```

2 - Create the .env
```bash
cp .env.example .env
```

3 - Configure the database settings
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=database_user
DB_PASSWORD=database_password
```

4 - Configure environment variables for Swoole and Swagger
```bash
OCTANE_SERVER=swoole

L5_SWAGGER_GENERATE_ALWAYS=true
L5_SWAGGER_CONST_HOST=http://127.0.0.1:8000/api/v1
```

5 - Run composer for download dependencies
```bash
composer install or composer update
```

6 - Run migrations for create tables
```bash
php artisan migrate --seed
```

## Basic usage

```bash
php artisan octane:start --watch or php artisan serve
```

## API Documentation

1 - Generate API Documentation
```bash
php artisan l5-swagger:generate
```

2 - Access via browser
```bash
http://127.0.0.1:8000/api/documentation
```

## Tests

1 - Run tests in console
```bash
php artisan test --coverage
```

2 - Generate coverage and html template
```bash
php artisan test --coverage-html public/dashboard-tests
```
