<?php

declare(strict_types=1);

namespace App\Services\PokeApi\Actions;

use App\DataTransferObjects\PokemonTypeData;
use App\Models\Pokemon;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

final class SyncBulkPokemonTypesAction
{
    private const FLATTEN_LEVEL = 1;

    /**
     * @param Collection<PokemonData> $pokemons
     * @return void
     */
    public function handle(Collection $pokemons): void
    {
        $dataTableToInsert = Pokemon::query()
            ->whereIn('pokeapi_id', $pokemons->pluck('pokeapi_id'))
            ->get()
            ->map(function (Pokemon $pokemon) use ($pokemons) {
                $types = $pokemons->where('pokeapi_id', $pokemon->pokeapi_id)->first()->types;

                return $types->map(fn (PokemonTypeData $type) => [
                    'pokemon_uuid' => $pokemon->uuid,
                    'type_uuid' => $type->uuid,
                ]);
            })
            ->flatten(self::FLATTEN_LEVEL)
            ->all();

            // First - delete previous associations
            DB::table('pokemon_type')
                ->whereIn('pokemon_uuid', Arr::pluck($dataTableToInsert, 'pokemon_uuid'))
                ->delete();

            // Next - Insert new associations
            DB::table('pokemon_type')
                ->insert($dataTableToInsert);
    }
}
