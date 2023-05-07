<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Illuminate\Support\Collection;

final readonly class PokemonData
{
    public function __construct(
        public ?string $uuid = null,
        public ?int $pokeapi_id = null,
        public string $name,
        public string $sprite_url,
        public int $weight,
        public int $height,

        public ?Collection $types,
    )
    {}
}
