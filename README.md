## Sports games validation app

### Requirements

-   Docker and docker compose installed and their services running

### How to run

#### 1. Set up the project

1. Get the source

```sh
git clone https://github.com/ontinko/laravel-validate-csv.git
cd laravel-validate-csv
```

2. Install all the dependencies

```sh
composer install
```

#### 2. Set up the initial configuration

Create `.env` file:

```sh
cp .env.example .env
```

In `.env`, set the ports (default value is 8000):

```
APP_PORT=<port>
```

Finally, generate a security key for the app:

```sh
php artisan key:generate
```

#### 3. Build docker images

```sh
docker compose build
```

#### 4. Run the app

```sh
docker compose up
```

The app will be available at `localhost:<port>` in your browser, where `<port>` is the `APP_PORT` value you set in `.env` file.
