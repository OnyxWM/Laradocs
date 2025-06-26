<flux:modal name="delete-confirm" class="md:w-96">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Delete</flux:heading>
            <flux:text class="mt-2">Are you sure you want to delete?</flux:text>
        </div>

        <div class="flex">
            <flux:spacer />
            <div class="flex justify-center items-center gap-x-2">
                <flux:modal.close>
                    <flux:button size="sm" variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" form="delete-form" size="sm" variant="danger">Delete</flux:button>
            </div>
        </div>
    </div>
</flux:modal>
