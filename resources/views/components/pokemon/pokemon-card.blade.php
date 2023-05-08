<article class="flex flex-col w-full max-w-[150px] p-2 text-center bg-gray-100/60 dark:bg-gray-100/40 rounded-lg">
    <section>
        <h2 class="text-lg font-semibold">{{ $pokemon->name }}</h2>
        <img src="{{ $pokemon->sprite_url }}" alt="{{ $pokemon->name }}" class="mx-auto">
        <section class="mt-2">
            <h3>{{ __('Types') }}</h3>
            <small>{{ $types }}</small>
        </section>
        <p class="flex justify-between text-sm"> <span class="font-semibold">{{ __('Weight') }}</span> <span>{{ $pokemon->weight }}</span></p>
        <p class="flex justify-between text-sm"> <span class="font-semibold">{{ __('Height') }}</span> <span>{{ $pokemon->height }}</span></p>
        <a href="{{ route('pokemons.edit', ['pokemon' => $pokemon->uuid]) }}" class="inline-flex justify-center items-center mt-4 px-4 py-2 bg-gray-800 w-full dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
            {{ __('Edit') }}
        </a>
    </section>
</article>
