<?php

declare(strict_types=1);

namespace App\Services\PokeApi\Actions;

use App\DataTransferObjects\PokemonData;
use App\Models\Pokemon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

final class UpsertBulkPokemonAction
{
    public function __construct(private SyncBulkPokemonTypesAction $syncTypesAction)
    {}
    /**
     * Upsert pokemons data from Api collection
     *
     * @param Collection<PokemonData> $pokemons
     * @return void
     */
    public function handle(Collection $pokemons): void
    {
        DB::transaction(function () use ($pokemons) {
            $dataTableToInsert = $pokemons->map(fn (PokemonData $type) => [
                'pokeapi_id' => $type->pokeapi_id,
                'name' => $type->name,
                'sprite_url' => $type->sprite_url,
                'weight' => $type->weight,
                'height' => $type->height,
            ])
                ->toArray();

            Pokemon::query()
                ->upsert(
                    values: $dataTableToInsert,
                    uniqueBy: 'pokeapi_id',
                );

                $this->syncTypesAction->handle($pokemons);
        });
    }
}
