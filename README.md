## Sports games validation app

### Requirements

-   Docker and docker compose installed and their services running

### How to run

#### 1. Get the project

```sh
git clone https://github.com/ontinko/laravel-validate-csv.git
cd laravel-validate-csv
```

#### 2. Set up the initial configuration

```sh
cp .env.example .env
```

In `.env`, set the ports:

```
APP_PORT=<port>
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
