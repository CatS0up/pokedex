## Screenshots 📺

![screenshot](https://raw.githubusercontent.com/CatS0up/pokedex/main/media/presentation.gif)

## Code Example/Issues 🔍


## Installation 💾
1. Rename `.env.example` as `.env`
2. Run the following commands:
```bash
~ docker-compose up --build -d
~ docker-compose exec app php artisan key:generate
~ docker-compose exec app php artisan migrate --seed
~ docker-compose exec app php artisan queue:work
~ docker-compose exec app php artisan pokeapi:fetch-pokemon-data-from-api
~ npm run dev
```

## Run 💻
- http://localhost/
- Click on the `Login` link (form is filled by testing data)
- Click on the `Pokedex` link

## Available scripts

| Command                                                                   | Description                             |     |
| ------------------------------------------------------------------------- | ----------------------------------------| --- |
| `docker-compose exec app php artisan pokeapi:fetch-pokemon-data-from-api` | Load pokemon data from API to database  |     |
