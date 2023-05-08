<?php

declare(strict_types=1);

namespace App\ViewModels\Pokemon;

use App\Factories\PokemonDataFactory;
use App\Models\Pokemon;
use App\ViewModels\ViewModel;
use Illuminate\Support\Collection;

class GetPokemonsViewModel extends ViewModel
{
    public function pokemons(): Collection
    {
       return Pokemon::query()
            ->with('types')
            ->get()
            ->map(fn (Pokemon $pokemon) => PokemonDataFactory::createFromModel($pokemon));
    }
}
