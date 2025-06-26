<x-layouts.app :title="__('Posts')">
    <div class="flex justify-between">
        <h1 class="text-4xl font-bold">Posts</h1>

        <form action="{{ route('posts.create')}}" method="get" class="mt-1">
            <flux:button variant="primary" type="submit">New Post</flux:button>
        </form>
    </div>

    <div class="mt-6">
        <ul class="grid grid-cols-3 gap-4">
            @foreach($posts as $post)
                <x-item-card
                    :href="route('posts.show', $post)"
                    :title="$post->title"
                    meta="{{ $post->created_at->diffForHumans() }} by {{ $post->user->name }}"
                />
            @endforeach
        </ul>

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </div>
</x-layouts.app>
