<?php

declare(strict_types=1);

namespace App\Actions;

final class SwitchLocaleAction
{
    public function handle(string $locale): string
    {
        session(['locale' => $locale]);
        app()->setLocale($locale);

        return app()->getLocale();
    }
}
