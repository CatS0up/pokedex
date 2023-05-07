<?php

namespace App\Console\Commands;

use App\Jobs\PokeApi\FetchPokemons;
use App\Jobs\PokeApi\FetchPokemonTypes;
use Illuminate\Bus\Batch;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Throwable;

class FetchPokemonDataFromApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pokeapi:fetch-pokemon-data-from-api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load pokemon data from API to database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            Bus::batch([
                new FetchPokemonTypes(),
                new FetchPokemons(),
            ])
                ->name('Fetch data from PokeApi')
                ->dispatch();

            } catch (Throwable $e) {
                Log::error("Fetch pokemon data command failed - {$e->getMessage()}");

                $this->error('Pokemon fetching failed');

                return self::FAILURE;
        }

            $this->info('Pokemons are being fetched...');

            return self::SUCCESS;
    }
}
