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
            {!! $recipe->html !!}
        </div>
        <h2 class="text-2xl font-semibold">Ингредиенты</h2>
        <table>
            @foreach($ingredients as $ingredient)
            <tr class="!bg-none border-bottom"><td>{{ $ingredient->value }}</td><td class="align-content-end">{{ $ingredient->quantity }}</td></tr>
            @endforeach
        </table>
        <h2 class="text-2xl font-semibold">Приготовление</h2>
        <ul>
            @foreach($steps as $step)
            <li class="!bg-none border-bottom">
                <img src="{{ $step->photo_url }}" />
                {{ $step->html }}
            </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
