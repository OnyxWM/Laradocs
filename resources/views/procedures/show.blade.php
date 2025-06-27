<x-layouts.app>
    <div class="max-w-7xl mx-auto">
        <div class="flex relative justify-center items-center border-b-2 border-zinc-800/10 dark:border-white/20 pb-4">
            <h1 class="text-4xl font-bold text-center dark:text-white">{{ $procedure->title }}</h1>
            <div class="absolute right-0">
                @can('update', $procedure)
                <form action="{{ route('procedures.edit', $procedure)}}" method="get">
                    @csrf
                    <flux:button variant="primary" type="submit">Edit</flux:button>
                </form>
                @endcan
            </div>

        </div>
        <div class="flex justify-center items-center mt-2">
            <flux:heading size="lg">{{ $procedure->department->name }}</flux:heading>
        </div>
        <div class="mt-6 prose max-w-4xl dark:prose-invert mx-auto">
            <p class=" dark:text-gray-100">{!! $procedure->html !!}</p>
            <span class="text-sm dark:text-gray-300">
                {{ $procedure->created_at->diffForHumans() }} by {{ $procedure->user->name }}
            </span>
        </div>
    </div>
</x-layouts.app>
