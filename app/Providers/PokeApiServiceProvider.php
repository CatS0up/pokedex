<?php

namespace App\Providers;

use App\Services\PokeApi\Requests\GetPokemonListRequest;
use App\Services\PokeApi\Requests\GetPokemonRequest;
use App\Services\PokeApi\Requests\GetPokemonTypesRequest;
use Illuminate\Support\ServiceProvider;

class PokeApiServiceProvider extends ServiceProvider
{
    private static function classes(): array
    {
        return [
            GetPokemonListRequest::class,
            GetPokemonTypesRequest::class,
        ];
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $classList = self::classes();

        foreach ($classList as $class) {
            $this->app->bind(
                abstract: $class,
                concrete: fn () => new $class(baseUrl: config('services.pokeapi.v2.url')),
            );
        }
    }
}
