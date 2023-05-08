<?php

namespace App\Http\Controllers;

use App\Actions\SwitchLocaleAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $locale, SwitchLocaleAction $action): RedirectResponse
    {
        $action->handle($locale);

        return to_route('pokemons.index');
    }
}
