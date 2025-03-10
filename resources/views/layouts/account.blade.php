<x-dropdown align="right" width="48">
    <x-slot name="trigger">
        <button>
            <x-icon icon="person_outline" size="text-3xl" />
        </button>
    </x-slot>

    <x-slot name="content">
        <x-dropdown.link :href="route('profile.edit')">
            {{ __('Profile') }}
        </x-dropdown.link>

        <x-form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown.link
                :href="route('logout')"
                onclick="event.preventDefault();
                                this.closest('form').submit();"
            >
                {{ __('Log out') }}
            </x-dropdown.link>
        </x-form>
    </x-slot>
</x-dropdown>
