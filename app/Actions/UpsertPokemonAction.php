<?php

declare(strict_types=1);

namespace App\Actions;

use App\DataTransferObjects\PokemonData;
use App\Models\Pokemon;

final class UpsertPokemonAction
{
    public function handle(PokemonData $pokemonData): Pokemon
    {
       $pokemon = Pokemon::query()
        ->updateOrCreate(
            attributes: [
                'uuid' => $pokemonData->uuid,
            ],
            values: [
                'name' => $pokemonData->name,
                'sprite_url' => $pokemonData->sprite_url,
                'height' => $pokemonData->height,
                'weight' => $pokemonData->weight,
            ],
        );

        $pokemon->types()->sync($pokemonData->types->pluck('uuid')->toArray());

        return $pokemon->load('types');
    }
}
