<?php

declare(strict_types=1);

namespace App\Services\PokeApi\Actions;

use App\DataTransferObjects\PokemonTypeData;
use App\Models\Type;
use Illuminate\Support\Collection;

final class UpsertBulkPokemonTypeAction
{
    /**
     * Upsert pokemon types data from Api collection
     *
     * @param Collection<PokemonTypeData> $pokemonTypes
     * @return void
     */
    public function handle(Collection $pokemonTypes): void
    {
        $dataTableToInsert = $pokemonTypes->map(fn (PokemonTypeData $type) => [
            'pokeapi_id' => $type->pokeapi_id,
            'name' => $type->name,
            'generation' => $type->generation,
        ])
        ->toArray();

        Type::query()
            ->upsert(
                values: $dataTableToInsert,
                uniqueBy: 'pokeapi_id',
            );
    }
}
