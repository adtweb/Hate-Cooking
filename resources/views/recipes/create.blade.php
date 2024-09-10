<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Изменение рецепта') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('recipe.create') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('update')

                        <div>
                            <x-input-label for="value" :value="__('Название')" />
                            <x-text-input id="value" name="value" type="text" class="mt-1 block w-full" required autofocus autocomplete="value" />
                            <x-input-error class="mt-2" :messages="$errors->get('value')" />
                        </div>

                        <div>
                            <x-input-label for="value" :value="__('Название')" />
                            <x-text-input id="value" name="value" type="text" class="mt-1 block w-full" required autofocus autocomplete="value" />
                            <x-input-error class="mt-2" :messages="$errors->get('value')" />
                        </div>

                        <div>
                            <x-input-label for="value" :value="__('Название')" />
                            <x-text-input id="value" name="value" type="text" class="mt-1 block w-full" required autofocus autocomplete="value" />
                            <x-input-error class="mt-2" :messages="$errors->get('value')" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

