<?php

use App\Models\User;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use Illuminate\Auth\Access\Gate;

new class extends Component {

    use WithPagination;

    public ?User $userToDelete = null;
    public bool $showDeleteModal = false;

    public function mount(): void
    {
        $this->authorize('is-manager');
    }

    public function confirmUserDeletion(User $user): void
    {
        $this->authorize('is-admin');
        $this->userToDelete = $user;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        $this->authorize('is-admin');

        if ($this->userToDelete && $this->userToDelete->id === auth()->id()) {
            $this->cancelDelete();
            return;
        }

        if ($this->userToDelete) {
            $this->userToDelete->delete();
            session()->flash('message', 'User deleted successfully.');
        }

        $this->cancelDelete();
    }

    public function cancelDelete(): void
    {
        $this->reset(['userToDelete', 'showDeleteModal']);
    }

    public function with(): array
    {
        return [
            'users' => User::latest()->paginate(10),
        ];
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Users')" :subheading=" __('Manage and Create Users.')">
        <div class="w-full">
            {{-- User List Table --}}
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm divide-y divide-gray-200 dark:divide-gray-700">
                    <thead>
                    <tr>
                        <th class="p-4 font-medium text-start text-gray-900 dark:text-white">Name</th>
                        <th class="p-4 font-medium text-start text-gray-900 dark:text-white">Email</th>
                        <th class="p-4 font-medium text-start text-gray-900 dark:text-white">Role</th>
                        <th class="p-4 font-medium text-end text-gray-900 dark:text-white">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($users as $user)
                        <tr wire:key="{{ $user->id }}">
                            <td class="p-4 font-medium text-gray-900 dark:text-white">{{ $user->name }}</td>
                            <td class="p-4 text-gray-700 dark:text-gray-200">{{ $user->email }}</td>
                            <td class="p-4 text-gray-700 dark:text-gray-200">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        {{ $user->isAdmin() ? 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100' : '' }}
                                        {{ $user->isManager() ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100' : '' }}
                                        {{ $user->role === 'user' ? 'bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100' : '' }}
                                    ">
                                        {{ ucfirst($user->role) }}
                                    </span>
                            </td>
                            <td class="p-4 text-end">
                                <flux:dropdown>
                                    <flux:button variant="ghost" icon="ellipsis-vertical" />
                                    <flux:menu>
                                        <flux:menu.item>Edit</flux:menu.item>
                                        <flux:menu.item>Reset Password</flux:menu.item>
                                        @can('is-admin')
                                            <flux:menu.separator />
                                            <flux:menu.item
                                                variant="danger"
                                                wire:click="confirmUserDeletion({{ $user->id }})">
                                                Delete
                                            </flux:menu.item>
                                        @endcan
                                    </flux:menu>
                                </flux:dropdown>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-500 dark:text-gray-400">
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination Links --}}
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
        @if($showDeleteModal && $userToDelete)
            <flux:modal wire:model="showDeleteModal">
                    <flux:heading size="lg">Confirm User Deletion</flux:heading>

                    <flux:text class="text-gray-600 dark:text-gray-400">
                        Are you sure you want to delete <strong>{{ $userToDelete->name }}</strong>?
                        This action cannot be undone.
                    </flux:text>
                    <div class="flex mt-4 justify-end space-x-3">
                        <flux:button variant="ghost" wire:click="cancelDelete">
                            Cancel
                        </flux:button>
                        <flux:button variant="danger" wire:click="delete">
                            Delete User
                        </flux:button>
                    </div>
            </flux:modal>
        @endif
    </x-settings.layout>
</section>
