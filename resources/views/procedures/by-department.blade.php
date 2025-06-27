<x-layouts.app :title="$department->name . ' Procedures'">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between border-b-2 pb-4 border-zinc-800/10 dark:border-white/20">
            <h1 class="text-4xl font-bold">{{ $department->name }} Procedures</h1>
            @can('is-manager')
                <form action="{{ route('procedures.create')}}" method="get" class="mt-1">
                    <flux:button variant="primary" type="submit">New Procedure</flux:button>
                </form>
            @endcan

        </div>

        <div class="mt-8 space-y-6">
            @forelse ($procedures as $procedure)
                @php
                    $color = $departmentColors[$department->name] ?? $departmentColors['default'];
                @endphp
                <div class="space-y-4">
                    <ul>
                        <x-item-card
                            :href="route('procedures.show', $procedure)"
                            :title="$procedure->title"
                            badgeText="{{ $department->name }}"
                            badgeColor="{{ $color }}"
                            meta="{{ $procedure->created_at->diffForHumans() }} by {{ $procedure->user->name }}"
                        />
                    </ul>
                </div>
            @empty
                <div class="p-6 text-center bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <p class="text-lg text-gray-500">There are no procedures for this department yet.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $procedures->links() }}
        </div>
    </div>
</x-layouts.app>
