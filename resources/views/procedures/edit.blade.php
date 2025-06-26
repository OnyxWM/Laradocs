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
                    <label for="title" class="text-2xl font-semibold">Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $procedure->title) }}" class="w-full mt-2 p-2 rounded-md text-xl bg-white border border-gray-300/50 shadow-xs dark:bg-gray-700" />
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-5">
                    <label for="department_id" class="text-2xl font-semibold">Department</label>
                    <select id="department_id" name="department_id" class="w-full mt-2 p-2 rounded-md text-xl bg-white border border-gray-300/50 shadow-xs dark:bg-gray-700">
                        <option value="" disabled selected>Select a Department</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" @selected(old('department_id', $procedure->department_id) == $department->id)>{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-10 h-full">
                    <label for="body" class="text-2xl font-semibold">
                        Body
                    </label>
                    <textarea id="body" name="body" class="w-full h-full mt-2 p-2 rounded-md text-md bg-white border border-gray-300/50 shadow-xs dark:bg-gray-700">{{ old('body', $procedure->body) }}</textarea>
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
