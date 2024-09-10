<x-app-layout>
    <div class="max-w-5xl mx-auto py-6 px-2">
        <ul class="divide-y">
            @foreach($recipes as $recipe)
                <li class="py-4 px-2">
                    <a href="{{ route('recipes.show', $recipe) }}"><img src="/storage/{{ $recipe->photo_url }}" alt="{{ $recipe->value }}" /></a>
                    <a href="{{ route('recipes.show', $recipe) }}"><h2>{{ $recipe->value }}</h2></a>
                    <div class="row">
                        <div class="col">Категории:</div>
                        @foreach($recipy->categories as $category)
                            <div class="col">{{ $category->value }}</div>
                        @endforeach
                    </div>
                    <div>{{ $recipe->description }}</div>
                    <span class="text-sm text-gray-600">
                        {{ $recipe->created_at->diffForHumans() }} от {{ $recipe->user->name }}
                    </span>
                </li>
            @endforeach
        </ul>

        <div class="mt-2">
            {{ $recipes->links() }}
        </div>
    </div>
</x-app-layout>
