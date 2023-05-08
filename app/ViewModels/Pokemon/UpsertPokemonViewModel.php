<?php

declare(strict_types=1);

namespace App\ViewModels\Pokemon;

use App\DataTransferObjects\PokemonData;
use App\Factories\PokemonDataFactory;
use App\Factories\PokemonTypeDataFactory;
use App\Models\Pokemon;
use App\Models\Type;
use App\ViewModels\ViewModel;
use Illuminate\Support\Collection;

class UpsertPokemonViewModel extends ViewModel
{
    public function __construct(private ?Pokemon $pokemon = null)
    {}

    public function pokemon(): ?PokemonData
    {
        if (!$this->pokemon) {
            return null;
        }

        return PokemonDataFactory::createFromModel($this->pokemon);
    }

    public function types(): Collection
    {
       return Type::query()
            ->get()
            ->map(fn (Type $type) => PokemonTypeDataFactory::createFromModel($type));
    }

    public function pokemonTypeUuids(): array
    {
        if (!$this->pokemon) {
            return [];
        }

        return $this->pokemon->types->pluck('uuid')->toArray();
    }
}
