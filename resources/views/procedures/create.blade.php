<x-layouts.app :title="__('New Procedure')">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between">
            <h1 class="text-4xl font-bold">New Procedure</h1>
        </div>

        <div class="flex min-h-[300px] mt-10">
            <form action="{{ route('procedures.store') }}" method="post" class="w-full">
                @csrf
                <div>
                    <label for="title" class="text-2xl font-semibold">Title</label>
                    <input type="text" id="title" name="title" class="w-full mt-2 p-2 rounded-md text-xl bg-white border border-gray-300/50 shadow-xs dark:bg-gray-700" />
                </div>

                <div class="mt-5">
                    <label for="department_id" class="text-2xl font-semibold">Department</label>
                    <select id="department_id" name="department_id" class="w-full mt-2 p-2 rounded-md text-xl bg-white border border-gray-300/50 shadow-xs dark:bg-gray-700">
                        <option value="" disabled selected>Select a Department</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-10 h-full">
                    <label for="body" class="text-2xl font-semibold">
                        Body
                    </label>
                    <textarea id="body" name="body" class="w-full h-full mt-2 p-2 rounded-md text-md bg-white border border-gray-300/50 shadow-xs dark:bg-gray-700"></textarea>
                    <flux:button variant="primary" class="mt-2" type="submit">Post</flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
