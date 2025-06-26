<x-layouts.app :title="__('Procedures')">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between">
            <h1 class="text-4xl font-bold">Procedures</h1>

            <form action="{{ route('procedures.create')}}" method="get" class="mt-1">
                <flux:button variant="primary" type="submit">New Procedure</flux:button>
            </form>
        </div>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">

            @foreach($departments as $department)
                @php
                    $color = $departmentColors[$department->name] ?? $departmentColors['default'];
                @endphp
                <div class="space-y-4">
                    <h2 class="text-2xl font-semibold border-b-2 pb-2 dark:text-white border-{{ $color }}-500">
                        {{ $department->name }}
                    </h2>

                    @forelse($department->procedures as $procedure)
                        <ul>
                            <x-item-card
                                :href="route('procedures.show', $procedure)"
                                :title="$procedure->title"
                                badgeText="{{ $department->name }}"
                                badgeColor="{{ $color }}"
                                meta="{{ $procedure->created_at->diffForHumans() }} by {{ $procedure->user->name }}"
                            />
                        </ul>
                    @empty
                        <p class="text-gray-500 dark:text-gray-400 italic">
                            No procedures in this department yet.
                        </p>
                    @endforelse
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.app>
