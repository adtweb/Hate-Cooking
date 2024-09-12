<x-app-layout>
    <x-slot name="header" class="p-4">
        <h2 class="sm:p-8 font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Новые рецепты') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                <ul class="divide-y">
            @foreach($recipes as $recipe)
                <li class="py-4 px-2">
                    <a href="{{ route('recipes.show', $recipe) }}"><h2 class="text-xl">{{ $recipe->value }}</h2></a>
                    <span class="text-sm text-gray-600">
                        {{ $recipe->created_at->diffForHumans() }} от {{ $recipe->user->name }}
                    </span>
                    <a href="{{ route('recipes.show', $recipe) }}"><img src="/storage/{{ $recipe->photo_url }}" alt="{{ $recipe->value }}" /></a>
                    <div class="p-5">
                        @foreach($recipe->categories as $category)
                            <div class="inline-flex text-sm">{{ $category->value }}</div>
                        @endforeach
                        @foreach($recipe->qualities as $quality)
                            <div class="inline-flex text-sm">{{ $quality->value }}</div>
                        @endforeach
                    </div>
                    <div>{!! $recipe->html !!}</div>
                </li>
            @endforeach
        </ul>

        <div class="mt-2">
            {{ $recipes->links() }}
        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
