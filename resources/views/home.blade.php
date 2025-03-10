<x-app-layout>
    <x-slot name="title">
        {{ __('Home') }}
    </x-slot>

    <x-slot name="content">
        <ul class="flex gap-4">
            <li class="w-1/6">
                <a class="inline-block w-full rounded border p-8 text-center" href="{{ route('repository.index') }}">
                    <x-icon icon="inventory" size="text-4xl" />
                    <span class="mt-2 block">{{ __('Repository') }}</span>
                </a>
            </li>
            <li class="w-1/6">
                <a class="inline-block w-full rounded border p-8 text-center" href="{{ route('profile.edit') }}">
                    <x-icon icon="person_outline" size="text-4xl" />
                    <span class="mt-2 block">{{ __('Profile') }}</span>
                </a>
            </li>
        </ul>
    </x-slot>
</x-app-layout>
