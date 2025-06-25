<x-layouts.app>
    <div class="grid justify-center mx-auto px-2 py-6">
        <div>
            <h1 class="text-4xl font-bold text-center dark:text-white">{{ $procedure->title }}</h1>

        </div>

        <div class="mt-6 prose dark:prose-invert max-w-prose">
            <p class=" dark:text-gray-100">{!! $procedure->html !!}</p>
            <span class="text-sm dark:text-gray-300">
                {{ $procedure->created_at->diffForHumans() }} by {{ $procedure->user->name }}
            </span>
        </div>
    </div>
</x-layouts.app>
