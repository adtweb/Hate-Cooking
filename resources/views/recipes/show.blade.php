<x-app-layout>
    <div class="max-w-5xl mx-auto px-2 py-6">
        <div>
            <h1>{{ $recipe->value }}</h1>
            <span class="text-sm text-gray-600">
                {{ $recipe->created_at->diffForHumans() }} от {{ $recipe->user->name }}
            </span>
        </div>
        <div>
            <img src="{{ $recipe->photo_url }}" alt="{{ $recipe->value }}" />
        </div>
        <div>
            {{ $recipe->description }}
        </div>
    </div>
</x-app-layout>
