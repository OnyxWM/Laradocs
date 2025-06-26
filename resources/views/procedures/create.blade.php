<x-layouts.app :title="__('New Procedure')">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between">
            <h1 class="text-4xl font-bold">New Procedure</h1>
        </div>

        <div class="flex min-h-[300px] mt-10">
            <form action="{{ route('procedures.store') }}" method="post" class="w-full">
                @csrf
                <div>
                    <flux:label id="title" size="xl">Title</flux:label>
                    <flux:input name="title" id="title" class="mt-2" />
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
                    <flux:textarea id="body" resize="vertical" name="body" class="mt-2"/>
                    <flux:button variant="primary" class="mt-2" type="submit">Post</flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
