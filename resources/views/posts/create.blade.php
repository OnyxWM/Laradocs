<x-layouts.app :title="__('New Post')">
    <div>
        <div class="flex justify-between">
            <h1 class="text-4xl font-bold">New Post</h1>
        </div>

        <div class="flex h-[800px] mt-10">
            <form action="{{ route('posts.store') }}" method="post" class="w-full">
                @csrf
                <div>
                    <label for="title" class="text-2xl font-semibold">Title</label>
                    <input type="text" id="title" name="title" class="w-full mt-2 rounded-md text-xl bg-white border border-gray-300/50 shadow-xs dark:bg-gray-700" />
                </div>


                <div class="mt-10 h-full">
                    <label for="body" class="text-2xl font-semibold">
                        Body
                    </label>
                    <textarea id="body" name="body" class="w-full h-full mt-2 rounded-md text-md bg-white border border-gray-300/50 shadow-xs dark:bg-gray-700"></textarea>
                    <flux:button variant="primary" class="mt-2" type="submit">Post</flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
