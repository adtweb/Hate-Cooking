<x-app-layout>
    <div>
        <ul>
            @foreach($recipes as $recipe)
                <a href="{{ route('recipes.index', $recipe) }}">
                    <img src="{{ $recipe->photo_url }}" alt="{{ $recipe->value }}" />
                    {{ $recipe->value }}
                </a>
                <span class="text-sm text-gray-600">
                    {{ $recipe->created_at->diffForHumans() }} от {{ $recipe->user->name }}
                </span>
            @endforeach
        </ul>
        <div>
            {{ $recipes->links() }}
        </div>
    </div>
</x-app-layout>
