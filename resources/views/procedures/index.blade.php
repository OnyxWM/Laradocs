<x-layouts.app :title="__('Procedures')">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between">
            <h1 class="text-4xl font-bold">Procedures</h1>

            <form action="{{ route('procedures.create')}}" method="get" class="mt-1">
                <flux:button variant="primary" type="submit">New Procedure</flux:button>
            </form>
        </div>

        <div class="mt-6">
            <ul class="grid grid-cols-3 gap-5">
                @foreach($procedures as $procedure)
                    <x-item-card
                        :href="route('procedures.show', $procedure)"
                        :title="$procedure->title"
                        badgeText="{{ $procedure->department->name }}"
                        badgeColor="cyan"
                        meta="{{ $procedure->created_at->diffForHumans() }} by {{ $procedure->user->name }}"
                    />
                @endforeach
            </ul>

            <div class="mt-6">
                {{ $procedures->links() }}
            </div>
        </div>
    </div>
</x-layouts.app>
