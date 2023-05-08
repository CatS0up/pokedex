<?php

namespace App\Http\Controllers\Pokemon;

use App\Actions\UpsertPokemonAction;
use App\Factories\PokemonDataFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pokemon\StorePokemonRequest;
use App\Http\Requests\Pokemon\UpdatePokemonRequest;
use App\Models\Pokemon;
use App\ViewModels\Pokemon\GetPokemonsViewModel;
use App\ViewModels\Pokemon\UpsertPokemonViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PokemonController extends Controller
{
    public function index(): View
    {
       return view(
        'pokemon.index',
        [
            'model' => (new GetPokemonsViewModel())->toArray(),
        ]);
    }

    public function create(): View
    {
        return view(
            'pokemon.create',
            [
                'model' => (new UpsertPokemonViewModel())->toArray(),
            ]
        );
    }

    public function store(StorePokemonRequest $request, UpsertPokemonAction $action): RedirectResponse
    {
        $pokemonData = PokemonDataFactory::createFromArray($request->validated());
        $action->handle($pokemonData);

        session()->flash('info', __(':pokemon has been created.', ['pokemon' => $pokemonData->name]));

        return to_route('pokemons.index');
    }

    public function edit(Pokemon $pokemon): View
    {
        return view(
            'pokemon.edit',
            [
                'model' => (new UpsertPokemonViewModel($pokemon))->toArray(),
            ]);
    }

    public function update(Pokemon $pokemon, UpdatePokemonRequest $request, UpsertPokemonAction $action): RedirectResponse
    {
        $pokemonData = PokemonDataFactory::createFromArray([
            'uuid' => $pokemon->uuid,
            ...$request->validated(),
        ]);

        $action->handle($pokemonData);

        session()->flash('info', __('Pokemon has been updated.'));

        return to_route('pokemons.index');
    }
}
