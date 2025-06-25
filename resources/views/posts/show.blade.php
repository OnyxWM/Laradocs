<x-layouts.app>
    <div class="grid justify-center mx-auto px-2 py-6">
        <div>
            <h1 class="text-4xl font-bold text-center dark:text-white">{{ $post->title }}</h1>

        </div>

        <div class="mt-6 prose dark:prose-invert">
            <p class=" dark:text-gray-100">{!! $post->html !!}</p>
            <span class="text-sm dark:text-gray-300">
                {{ $post->created_at->diffForHumans() }} by {{ $post->user->name }}
            </span>
        </div>

        <div class="mt-12">
            <h2 class="text-2xl dark:text-white font-semibold">Comments</h2>
            @auth
                <form action="{{ route('posts.comments.store', $post) }}" method="post" class="mt-1">
                    @csrf

                    <textarea name="body" id="body" cols="30" rows="5" class="w-full mb-2 border border-gray-300/75 shadow dark:bg-gray-700 rounded-md"></textarea>
                    <flux:button variant="primary" type="submit">Add Comment</flux:button>
                </form>
            @endauth
            <ul class="divide-y mt-6">
                @foreach($comments as $comment)
                    <li class="py-4 px-2">
                        {{ $comment->body }}

                        <span class="text-sm text-gray-300">
                            {{ $comment->created_at->diffForHumans() }} by {{ $comment->user->name }}
                        </span>

                        @can('delete', $comment)
                        <form action="{{ route('posts.comments.destroy', ['post' => $post, 'comment' => $comment]) }}" method="post" class="mt-1">
                            @csrf
                            @method('DELETE')

                            <flux:button variant="danger" type="submit">Delete</flux:button>
                        </form>
                        @endcan
                    </li>
                @endforeach
            </ul>

            <div class="mt-2">
                {{ $comments->links() }}
            </div>
        </div>
    </div>
</x-layouts.app>
