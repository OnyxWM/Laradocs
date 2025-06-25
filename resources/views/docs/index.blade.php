<x-layouts.app :title="__('Documentation')">
    <div class="flex justify-between">
        <h1 class="text-4xl font-bold">Posts</h1>

        <form action="{{ route('docs.create')}}" method="get" class="mt-1">
            <flux:button variant="primary" type="submit">Create Documention</flux:button>
        </form>
    </div>

    <div class="mt-6">
        <ul class="space-y-4">
            @foreach($docs as $doc)
                <li class="py-4 px-2 dark:bg-gray-700/25 border border-gray-300/75 dark:border-gray-600/50 hover:dark:border-gray-400 hover:shadow-md hover:dark:shadow-gray-700 rounded-md">
                    <a href="{{ route('docs.show', $doc) }}" class="block w-full h-full">
                        <div>
                            <span class="text-xl dark:text-gray-200 hover:dark:text-white font-bold">{{ $doc->title }}</span>
                            <span class="text-sm dark:text-gray-300">
                            {{ $doc->created_at->diffForHumans() }} by {{ $doc->user->name }}
                            </span>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="mt-6">
            {{ $doc->links() }}
        </div>
    </div>
</x-layouts.app>
