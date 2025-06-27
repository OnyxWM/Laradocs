<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Users')" :subheading=" __('Manage and Create Users.')">

    </x-settings.layout>
</section>
