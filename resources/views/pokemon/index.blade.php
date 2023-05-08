<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pokedex') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                    @if (session()->has('info'))
                        {{ session()->get('info') }}
                    @endif
                </div>
                <div class="flex flex-wrap justify-center mt-2 p-6 text-gray-900 dark:text-gray-100 gap-4">
                    @forelse ($model['pokemons'] as $pokemon)
                    <x-pokemon.pokemon-card :$pokemon/>
                    @empty
                        {{ __('Empty') }}
                    @endforelse
                </div>
                <a href="{{ route('pokemons.create') }}" class="inline-flex justify-center items-center mt-4 px-4 py-2 bg-gray-800 w-full dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    {{ __('Add') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
