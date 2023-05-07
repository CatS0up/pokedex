<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

final readonly class PokemonTypeData
{
    public function __construct(
        public ?string $uuid = null,
        public ?int $pokeapi_id = null,
        public string $name,
        public string $generation,
    )
    {}
}
