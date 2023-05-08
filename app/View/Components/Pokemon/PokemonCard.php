<?php

namespace App\View\Components\Pokemon;

use App\DataTransferObjects\PokemonData;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PokemonCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public PokemonData $pokemon,
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pokemon.pokemon-card');
    }

    public function types(): string
    {
        return $this->pokemon->types->pluck('name')->join(', ');
    }
}
