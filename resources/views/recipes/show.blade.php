<x-app-layout>
    <div class="max-w-5xl mx-auto px-2 py-6">
        <div>
            <img src="/storage/{{ $recipe->photo_url }}" alt="{{ $recipe->value }}" />
            <h1 class="text-3xl font-semibold">{{ $recipe->value }}</h1>
            <div class="row">
                @foreach($recipe->categories as $category)
                    <div class="col bg-light">{{ $category->value }}</div>
                @endforeach
                @foreach($recipe->qualities as $quality)
                    <div class="col bg-info">{{ $quality->value }}</div>
                @endforeach
            </div>
            <span class="text-sm text-gray-600">
                {{ $recipe->created_at->diffForHumans() }} by {{ $recipe->user->name }}
            </span>
        </div>

        <div class="prose mt-6">
            {!! $recipe->html !!}
        </div>

        <div class="mt-12">
            <h2 id="ingredients" class="text-2xl font-semibold">Ингредиенты</h2>
            <div class="row">
                @foreach($recipe->ingredients as $ingredient)
                    <div class="col bg-light border-bottom">{{ $ingredient->value }}</div>
                    <div class="col bg-light border-bottom">{{ $ingredient->quantity }}</div>
                @endforeach
            </div>
        </div>

        <div class="mt-12">
            <h2 id="ingredients" class="text-2xl font-semibold">Приготовление</h2>
            <div class="row">
                @foreach($recipe->steps as $step)
                    <div class="col bg-light border-bottom">
                        <img src="/storage/{{ $step->photo_url }}" alt="{{ ++$i }}" />
                        {{ $step->html }}
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-12">
            <h2 id="comments" class="text-2xl font-semibold">Отзывы</h2>

            @auth
                <form action="{{ route('recipes.comments.store', $recipe) }}" method="recipe" class="mt-2">
                    @csrf

                    <textarea name="description" id="description" cols="30" rows="5" class="w-full"></textarea>
                    <x-primary-button type="submit">Добавить отзыв</x-primary-button>
                </form>
            @endauth

            <ul class="divide-y mt-4">
                @foreach($recipe->comments as $comment)
                    <li class="py-4 px-2">
                        <p>{{ $comment->body }}</p>
                        <span class="text-sm text-gray-600">
                            {{ $comment->created_at->diffForHumans() }} by {{ $comment->user->name }}
                        </span>

                        @can('delete', $comment)
                            <form
                                action="{{ route('recipes.comments.destroy', ['recipe' => $recipe, 'comment' => $comment]) }}"
                                method="recipe" class="mt-2">
                                @csrf
                                @method('DELETE')

                                <x-danger-button type="submit">Удалить</x-danger-button>
                            </form>
                        @endcan
                    </li>
                @endforeach
            </ul>

            <div class="mt-2">
                {{ $comments->fragment('comments')->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
