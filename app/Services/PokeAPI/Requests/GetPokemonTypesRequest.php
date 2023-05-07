<?php

declare(strict_types=1);

namespace App\Services\PokeApi\Requests;

use App\DataTransferObjects\PokemonTypeData;
use App\Factories\PokemonTypeDataFactory;
use App\Services\Request;
use Illuminate\Http\Client\Pool;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class GetPokemonTypesRequest extends Request
{
    /**
     * @return Collection<PokemonTypeData>
     */
    public function send(array $params = []): Collection
    {
        $response = $this->getTypeGeneralList();
        $responses = $this->getTypesDetails($response);

        $types = collect();
        foreach ($responses as $response) {
            $types->push(PokemonTypeDataFactory::createFromApiResponse($response));
        }

        return $types;
    }

    private function getTypeGeneralList(array $params = []): Response
    {
        return Http::get(
            url: $this->url('type'),
            query: $params,
        )
            ->throw();
    }

    private function getTypesDetails(Response $response): array
    {
        return Http::pool(function (Pool $pool) use ($response) {
            $pokemons = $response->json('results');

            /** @var Promise[] $promises */
            $promises = [];

            foreach ($pokemons as $datum) {
                $promises[] = $pool->get($this->url("type/{$datum['name']}"));
            }

            return $promises;
        });
    }
}
