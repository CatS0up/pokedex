<?php

namespace App\Jobs\PokeApi;

use App\Services\PokeApi\Actions\UpsertBulkPokemonTypeAction;
use App\Services\PokeApi\Requests\GetPokemonTypesRequest;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchPokemonTypes implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    /**
     * Execute the job.
     */
    public function handle(GetPokemonTypesRequest $request, UpsertBulkPokemonTypeAction $action): void
    {
        $action->handle($request->send());
    }
}
