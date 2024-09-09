<x-app-layout>
    <div class="max-w-5xl mx-auto py-6 px-2">
        <ul class="divide-y">
            @foreach($recipes as $recipe)
                <li class="py-4 px-2">
                    <img src="/storage/{{ $recipe->photo_url }}" alt="{{ $recipe->value }}" />
                    <a href="{{ route('recipes.show', $recipe) }}" class="text-xl font-semibold block">{{ $recipe->value }}</a>
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
