<x-app-layout>
    <x-slot name="title">
        {{ __('Profile') }}
    </x-slot>

    <x-slot name="content">
        <div>
            @include('profile.partials.update-profile-information-form')
        </div>
        <div class="mt-12">
            @include('profile.partials.update-password-form')
        </div>
        <div class="mt-12">
            @include('profile.partials.delete-user-form')
        </div>
    </x-slot>
</x-app-layout>
