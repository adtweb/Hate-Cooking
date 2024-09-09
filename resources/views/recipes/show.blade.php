<x-app-layout>
    <div class="max-w-5xl mx-auto px-2 py-6">
        <div>
            <h1 class="text-3xl font-semibold">{{ $recipe->title }}</h1>
            <span class="text-sm text-gray-600">
                {{ $recipe->created_at->diffForHumans() }} by {{ $recipe->user->name }}
            </span>
        </div>

        <div class="prose mt-6">
            {!! $recipe->html !!}
        </div>

        <div class="mt-12">
            <h2 id="comments" class="text-2xl font-semibold">Comments</h2>

            @auth
                <form action="{{ route('recipes.comments.store', $recipe) }}" method="recipe" class="mt-2">
                    @csrf

                    <textarea name="body" id="body" cols="30" rows="5" class="w-full"></textarea>
                    <x-primary-button type="submit">Add Comment</x-primary-button>
                </form>
            @endauth

            <ul class="divide-y mt-4">
                @foreach($comments as $comment)
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

                                <x-danger-button type="submit">Delete</x-danger-button>
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
