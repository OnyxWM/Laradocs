@props([
    'href',
    'title',
    'badgeText' => null,
    'badgeColor' => 'gray',
    'meta' => null
])

<li class="py-4 px-2 bg-zinc-600/5 dark:bg-gray-700/25 border border-gray-300/75 hover:dark:bg-white/5 dark:border-gray-600/50 hover:dark:border-white/5 hover:shadow-md hover:dark:shadow-white/5 rounded-md">
    <a href="{{ $href }}" class="block w-full h-full">
        <div class="flex justify-between">
            <flux:heading size="lg" >{{ $title }}</flux:heading>
            @if ($badgeText)
                <div class="grid justify-items-center">
                    <flux:badge color="{{ $badgeColor }}">{{ $badgeText }}</flux:badge>
                </div>
            @endif
        </div>
        <div>
            @if ($meta)
                <flux:text>{{ $meta }}</flux:text>
            @endif
        </div>
    </a>
</li>
