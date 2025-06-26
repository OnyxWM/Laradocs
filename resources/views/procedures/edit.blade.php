<x-layouts.app :title="__('Edit Procedure')">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between">
            <h1 class="text-4xl font-bold">Edit Procedure</h1>
        </div>

        <div class="flex min-h-[300px] mt-10">
            <form action="{{ route('procedures.update', $procedure) }}" method="post" class="w-full">
                @csrf
                @method('PATCH')
                <div>
                    <flux:heading size="xl">Title</flux:heading>
                    <flux:input name="title" id="title" class="mt-2" value="{{ old('title', $procedure->title) }}" />
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-5">
                    <flux:heading size="xl">Department</flux:heading>
                    <flux:select
                        id="department_id"
                        wire:model="department_id"
                        class="w-full mt-2"
                        placeholder="Select a Department"
                    >
                        <flux:select.option value="1">Sales</flux:select.option>
                        <flux:select.option value="2">Dispatch</flux:select.option>
                        <flux:select.option value="3">Assembly</flux:select.option>
                    </flux:select>
                    @error('department_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-10 h-full">
                    <flux:heading size="xl">Body</flux:heading>
                    <flux:textarea id="body" resize="vertical" name="body" class="mt-2">{{ old('body', $procedure->body) }}</flux:textarea>
                    <div class="flex mt-2 items-center gap-x-4">
                        <flux:modal.trigger name="delete-confirm">
                            <flux:button variant="danger">Delete</flux:button>
                        </flux:modal.trigger>
                        <flux:button variant="primary" type="submit">Update</flux:button>
                    </div>
                </div>
            </form>
            <form id="delete-form" action="{{ route('procedures.destroy', $procedure)}}" method="post">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
    <x-flux.delete-confirm />
</x-layouts.app>
