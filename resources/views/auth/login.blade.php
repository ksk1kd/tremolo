<x-guest-layout>
    <x-form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-form.input-label for="email" :value="__('Email')" />
            <x-form.text-input
                id="email"
                class="w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
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
                autocomplete="current-password"
            />

            <x-form.input-error :messages="$errors->get('password')" />
        </div>

        <div class="flex items-center justify-center">
            <x-button>
                {{ __('Log in') }}
            </x-button>
        </div>
    </x-form>
</x-guest-layout>
