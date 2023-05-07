<?php

declare(strict_types=1);

namespace App\Services\PokeApi\Requests;

use App\Factories\PokemonDataFactory;
use App\Services\Request;
use GuzzleHttp\Promise\Promise;
use Illuminate\Http\Client\Pool;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class GetPokemonListRequest extends Request
{
    /**
     * @return Collection<PokemonData>
     */
    public function send(array $params = []): Collection
    {
        $response = $this->getPokemonGeneralList();
        $responses = $this->getPokemonsDetails($response);

        $pokemons = collect();
        foreach ($responses as $response) {
            $pokemons->push(PokemonDataFactory::createFromApiResponse($response));
        }

        return $pokemons;
    }

    private function getPokemonGeneralList(array $params = []): Response
    {
        return Http::get(
            url: $this->url('pokemon'),
            query: $params,
        )
        ->throw();
    }

    private function getPokemonsDetails(Response $response): array
    {
        return Http::pool(function (Pool $pool) use ($response) {
            $pokemons = $response->json('results');

            /** @var Promise[] $promises */
            $promises = [];

            foreach ($pokemons as $datum) {
                $promises[] = $pool->get($this->url("pokemon/{$datum['name']}"));
            }

            return $promises;
        });
    }
}
