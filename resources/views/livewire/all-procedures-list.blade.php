<?php

use App\Models\Procedure;
use Livewire\WithPagination;
use Livewire\Volt\Component;

new class extends Component
{
    use WithPagination;

    public $departmentColors = [];

    public function with(): array
    {
        return [
        'allProcedures' => Procedure::latest()
            ->with(['user', 'department'])
            ->paginate(10),
        ];
    }
}; ?>

<div>
    {{-- Container for the single-column list --}}
    <div >
        <ul class="space-y-5">
        @forelse($allProcedures as $procedure)
            <x-item-card
                :href="route('procedures.show', $procedure)"
                :title="$procedure->title"
                badgeText="{{ $procedure->department->name }}"
                :badgeColor="$departmentColors[$procedure->department->name] ?? 'gray'"
                meta="{{ $procedure->created_at->diffForHumans() }} by {{ $procedure->user->name }}"
            />
        @empty
            <p class="text-gray-500 dark:text-gray-400 italic">
                There are no procedures yet.
            </p>
        @endforelse
        </ul>
    </div>

    {{-- Pagination Logic --}}
    @if ($allProcedures->hasMorePages())
        <div class="mt-8 flex justify-center">
            {{-- This button will automatically fetch the next page and append the results --}}
            <flux:button wire:click="loadMore" wire:loading.attr="disabled">
                <span wire:loading.remove>Load More</span>
                <span wire:loading>Loading...</span>
            </flux:button>
        </div>
    @endif
</div>
