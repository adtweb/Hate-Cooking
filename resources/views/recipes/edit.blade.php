<x-app-layout>
    <x-slot name="header" class="p-4">
        <h2 class="sm:p-8 font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Изменение рецепта') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('recipes.store', $recipe) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
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
                            <x-text-input id="photo_url" name="photo_url" type="file" class="mt-1 block w-full" />
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
                                        <input type="checkbox" id="{{ $category->id }}" value="{{ $category->id }}" class="mt-1" name="categories[]" @checked(old('categories[]') ?: $recipe->categories->find($category->id)) /> {{ $category->value }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div>
                            <x-input-label for="quality" :value="__('Дополнительные свойства')" />
                            @foreach(\App\Models\Quality::all() as $quality)
                                <div class="inline-flex p-5">
                                    <label>{{ $recipe->quality_id }}
                                        <input type="checkbox" id="{{ $quality->id }}" value="{{ $quality->id }}" class="mt-1" name="qualities[]" @checked(old('qualities[]') ?: $recipe->qualities->find($quality->id)) /> {{ $quality->value }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <x-primary-button type="submit">Сохранить</x-primary-button>
                    </form>
                    <div class="mt-12">
                        <h2 id="ingredients" class="text-2xl font-semibold">Ингредиенты</h2>
                        @if(!$recipe->ingredients)
                            <p>Ингредиенты не добавлены</p>
                        @endif
                            <form action="{{ route('recipes.ingredients.store', $recipe) }}" method="POST" class="mt-2" enctype="multipart/form-data">
                                @csrf
                                @method('POST')

                                <div>
                                    <x-input-label for="value" :value="__('Продукт')" />
                                    <x-text-input id="value" name="value" type="text" class="mt-1 block w-full" :value="old('value')" required autofocus autocomplete="value" />
                                    <x-input-error class="mt-2" :messages="$errors->get('value')" />
                                </div>
                                <div>
                                    <x-input-label for="value" :value="__('Количество')" />
                                    <x-text-input id="quantity" name="quantity" type="text" class="mt-1 block w-full" :value="old('value')" required autofocus autocomplete="quantity" />
                                    <x-input-error class="mt-2" :messages="$errors->get('quantity')" />
                                </div>
                                <x-primary-button type="submit">Добавить ингредиент</x-primary-button>
                            </form>
                        <table style="width:100%">
                        @foreach($recipe->ingredients as $ingredient)
                            <tr class="border-bottom">
                                <td class="bg-light border-bottom">{{ $ingredient->value }}</td>
                                <td class="bg-light border-bottom bold align-text-right">{{ $ingredient->quantity }}</td>
                                <td class="bg-light border-bottom align-text-right">
                                    <form
                                        action="{{ route('recipes.ingredients.destroy', ['recipe' => $recipe, 'ingredient' => $ingredient]) }}"
                                        method="POST" class="mt-2">
                                        @csrf
                                        @method('DELETE')

                                        <x-danger-button type="submit">Удалить</x-danger-button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                        </table>
                    </div>

                    <div class="mt-12">
                        <h2 id="ingredients" class="text-2xl font-semibold">Приготовление</h2>
                        @if(!$recipe->steps)
                            <p>Способ приготовления не добавлен</p>
                        @endif
                        <form action="{{ route('recipes.steps.store', $recipe) }}" method="POST" class="mt-2" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <x-input-label for="photo_url" :value="__('Фотография')" />
                            <x-text-input id="photo_url" name="photo_url" type="file" class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('photo_url')" />
                            <textarea name="description" id="description" cols="30" rows="5" class="w-full">{{ old('description') }}</textarea>
                            <x-primary-button type="submit">Добавить шаг</x-primary-button>
                        </form>
                        <table style="width:100%">
                        @foreach($recipe->steps as $step)
                            <tr class="border-bottom">
                                <td class="bg-light border-bottom">
                                    <img src="/storage/{{ $step->photo_url }}" alt="{{ $loop->iteration }}" />
                                </td>
                                <td class="bg-light border-bottom">
                                    {!! $step->html !!}
                                </td>
                                <td class="bg-light border-bottom">
                                    <form
                                        action="{{ route('recipes.steps.destroy', ['recipe' => $recipe, 'step' => $step]) }}"
                                        method="POST" class="mt-2">
                                        @csrf
                                        @method('DELETE')

                                        <x-danger-button type="submit">Удалить</x-danger-button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
