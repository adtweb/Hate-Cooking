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
                    <form method="POST" action="{{ route('recipes.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div>
                            <x-input-label for="value" :value="__('Название')" />
                            <x-text-input id="value" name="value" type="text" class="mt-1 block w-full" :value="old('value') ?: $recipe->value" required autofocus autocomplete="value" />
                            <x-input-error class="mt-2" :messages="$errors->get('value')" />
                        </div>

                        <div>
                            <x-input-label for="photo_url" :value="__('Фотография')" />
                            <img src="/storage/{{ $recipe->photo_url }}" alt="{{ $recipe->value }}" />
                            <x-text-input id="photo_url" name="photo_url" type="file" class="mt-1 block w-full" :value="{{ $recipe->value }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('photo_url')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Описание')" />
                            <textarea name="description" id="description" cols="30" rows="10">{{ old('description') ?: $recipe->description }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>
                        <div>
                            <x-input-label for="category" :value="__('Категория')" />
                            @foreach(\App\Models\Category::all() as $category)
                                <div class="inline-flex p-5">
                                    <label>
                                        <input type="checkbox" value="{{ $category->id }}" class="mt-1" name="categories[]" @checked(old('categories[$category->id]')) /> {{ $category->value }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div>
                            <x-input-label for="quality" :value="__('Дополнительные свойства')" />
                            @foreach(\App\Models\Quality::all() as $quality)
                                <div class="inline-flex p-5">
                                    <label>
                                        <input type="checkbox" value="{{ $quality->id }}" class="mt-1" name="qualities[]" @checked(old('qualities[$quality->id]')) /> {{ $quality->value }}
                                    </label> {{ $quality->value }}
                                </div>
                            @endforeach
                        </div>
                        <x-primary-button type="submit">Сохранить</x-primary-button>
                    </form>
                    <div class="mt-12">
                        <h2 id="ingredients" class="text-2xl font-semibold">Ингредиенты</h2>
                        @foreach($ingredients as $ingredient)
                            <div class="row">
                                <div class="col bg-light border-bottom">{{ $ingredient->value }}</div>
                                <div class="col bg-light border-bottom bold">{{ $ingredient->quantity }}</div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-12">
                        <h2 id="ingredients" class="text-2xl font-semibold">Приготовление</h2>
                        @foreach($steps as $step)
                            <div class="row">
                                <div class="col bg-light border-bottom">
                                    <img src="/storage/{{ $step->photo_url }}" alt="{{ $loop->iteration }}" />
                                </div>
                                <div class="col bg-light border-bottom">
                                    {!! $step->html !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
