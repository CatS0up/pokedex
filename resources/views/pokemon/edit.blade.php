<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit pokemon') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="post" action="{{ route('pokemons.update', ['pokemon' => $model['pokemon']->uuid]) }}">
                @method('put')
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $model['pokemon']->name)" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Sprite URL -->
                <div class="mt-4">
                    <x-input-label for="sprite_url" :value="__('Sprite URL')" />
                    <x-text-input id="sprite_url" class="block mt-1 w-full" type="text" name="sprite_url" :value="old('sprite_url', $model['pokemon']->sprite_url)" required />
                    <x-input-error :messages="$errors->get('sprite_url')" class="mt-2" />
                </div>

                <!-- Weight -->
                <div class="mt-4">
                    <x-input-label for="weight" :value="__('Weight')" />
                    <x-text-input id="weight" class="block mt-1 w-full" type="number" name="weight" :value="old('weight', $model['pokemon']->weight)" required min="1" />
                    <x-input-error :messages="$errors->get('weight')" class="mt-2" />
                </div>

                <!-- Height -->
                <div class="mt-4">
                    <x-input-label for="height" :value="__('Height')" />
                    <x-text-input id="height" class="block mt-1 w-full" type="number" name="height" :value="old('height', $model['pokemon']->height)" required min="1" />
                    <x-input-error :messages="$errors->get('height')" class="mt-2" />
                </div>

                <!-- Types -->
                <div class="mt-4">
                    <x-input-label for="types" :value="__('Types')" />
                    <select id="types" name="types[]" class='w-full mt-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm' multiple>
                        @forelse ($model['types'] as $type)
                        <option value="{{ $type->uuid }}" @selected(in_array($type->uuid, $model['pokemon_type_uuids']))>{{ $type->name }}</option>
                        @empty
                        <option selected>__('Empty')</option>
                        @endforelse
                    </select>
                    <x-input-error :messages="$errors->get('types')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-4">
                        {{ __('Edit') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
</x-app-layout>
