<section>
    <header>
        <x-h2>
            {{ __('Update Password') }}
        </x-h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <x-form method="POST" action="{{ route('password.update') }}" class="mt-6">
        @csrf
        @method('put')

        <div>
            <x-form.input-label for="current_password" :value="__('Current Password')" />
            <x-form.text-input
                id="current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
            />
            <x-form.input-error :messages="$errors->updatePassword->get('current_password')" />
        </div>

        <div>
            <x-form.input-label for="password" :value="__('New Password')" />
            <x-form.text-input id="password" name="password" type="password" autocomplete="new-password" />
            <x-form.input-error :messages="$errors->updatePassword->get('password')" />
        </div>

        <div>
            <x-form.input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-form.text-input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
            />
            <x-form.input-error :messages="$errors->updatePassword->get('password_confirmation')" />
        </div>

        <div class="flex items-center gap-4">
            <x-button>
                {{ __('Save') }}
            </x-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => (show = false), 2000)"
                    class="text-sm text-gray-600"
                >
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </x-form>
</section>
