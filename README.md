## About Installation of the project

In order to get started with the project you first need to clone the repository by using this command

```
git clone https://github.com/syedarifiqbal/film-app
```

Copy the `.env.example` file to `.env`.

```
cp .env.example .env
```

Generate application key

```
php artisan key:generate
```

Installing dependencies

```
composer install && npm i
```

## Database setup and migration

Please update the database setting/credentials in `.env` file and run the migration and seed the database.
```
php artisan migrate --seed
```

## Running server

To start server and test the application

```
php artisan serve
```

Go to the url `http://localhost:8000`

### Running test
```
composer test
```

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
