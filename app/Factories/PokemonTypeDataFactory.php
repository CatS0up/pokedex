<?php

declare(strict_types=1);

namespace App\Factories;

use App\DataTransferObjects\PokemonTypeData;
use App\Models\Type;
use Illuminate\Http\Client\Response;

class PokemonTypeDataFactory
{
    public static function createFromApiResponse(Response $response): PokemonTypeData
    {
        $data = $response->json();

        // We skip uuid because it is from existing model - not from api
        return new PokemonTypeData(
            uuid: null,
            pokeapi_id: data_get($data, 'id'),
            name: data_get($data, 'name'),
            generation: data_get($data, 'generation.name'),
        );
    }

    public static function createFromModel(Type $type): PokemonTypeData
    {
        return new PokemonTypeData(
            uuid: $type->uuid,
            pokeapi_id: $type->pokeapi_id,
            name: $type->name,
            generation: $type->generation,
        );
    }
}
