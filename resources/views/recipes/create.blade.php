<x-app-layout>
    <x-slot name="header" class="p-4">
        <h2 class="sm:p-8 font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Новый рецепт') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('recipes.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div>
                            <x-input-label for="value" :value="__('Название')" />
                            <x-text-input id="value" name="value" type="text" class="mt-1 block w-full" :value="old('value')" required autofocus autocomplete="value" />
                            <x-input-error class="mt-2" :messages="$errors->get('value')" />
                        </div>

                        <div>
                            <x-input-label for="photo_url" :value="__('Фотография')" />
                            <x-text-input id="photo_url" name="photo_url" type="file" class="mt-1 block w-full" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('photo_url')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Описание')" />
                            <textarea name="description" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>
                        <div>
                            <x-input-label for="category" :value="__('Категория')" />
                            @foreach(\App\Models\Category::all() as $category)
                                <div class="inline-flex p-5">
                                    <input type="checkbox" value="{{ $category->id }}" class="mt-1" name="categories[]" @checked(old('categories[]')) /> {{ $category->value }}
                                </div>
                            @endforeach
                        </div>
                        <div>
                            <x-input-label for="quality" :value="__('Дополнительные свойства')" />
                            @foreach(\App\Models\Quality::all() as $quality)
                                <div class="inline-flex p-5">
                                    <input type="checkbox" value="{{ $quality->id }}" class="mt-1" name="qualities[]" @checked(old('qualities[]')) /> {{ $quality->value }}
                                </div>
                            @endforeach
                        </div>
                        <x-primary-button type="submit">Добавить</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

