<?php

declare(strict_types=1);

namespace App\Factories;

use App\DataTransferObjects\PokemonData;
use App\Models\Type;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;

class PokemonDataFactory
{
    public static function createFromApiResponse(Response $response): PokemonData
    {
        $data = $response->json();

        $types = (data_get($data, 'types'));
        $typeNames = [];
        foreach ($types as $type) {
            $typeNames[] = data_get($type, 'type.name');
        }

        /** @var Collection<PokemonTypeData> $typeCollection */
        $typeCollection = Type::query()
            ->whereIn('name', $typeNames)
            ->get()
            ->collect()
            ->map(
                fn (Type $type) => PokemonTypeDataFactory::createFromModel($type)
            );

        // We skip uuid because it is from existing model - not from api
        return new PokemonData(
            uuid: null,
            pokeapi_id: data_get($data, 'id'),
            name: data_get($data, 'name'),
            sprite_url: data_get($data, 'sprites.front_default'),
            height: data_get($data, 'height'),
            weight: data_get($data, 'weight'),
            types: $typeCollection,
        );
    }
}
