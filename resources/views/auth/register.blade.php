<x-guest-layout>
    <x-form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-form.input-label for="name" :value="__('Name')" />
            <x-form.text-input
                id="name"
                class="w-full"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                autocomplete="name"
            />
            <x-form.input-error :messages="$errors->get('name')" />
        </div>

        <div>
            <x-form.input-label for="email" :value="__('Email')" />
            <x-form.text-input
                id="email"
                class="w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autocomplete="username"
            />
            <x-form.input-error :messages="$errors->get('email')" />
        </div>

        <div>
            <x-form.input-label for="password" :value="__('Password')" />
            <x-form.text-input
                id="password"
                class="w-full"
                type="password"
                name="password"
                required
                autocomplete="new-password"
            />
            <x-form.input-error :messages="$errors->get('password')" />
        </div>

        <div>
            <x-form.input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-form.text-input
                id="password_confirmation"
                class="w-full"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
            />
            <x-form.input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <div class="flex items-center justify-center">
            <x-button>
                {{ __('Register') }}
            </x-button>
        </div>
    </x-form>
</x-guest-layout>
