<section class="space-y-6">
    <header>
        <x-h2>
            {{ __('Delete Account') }}
        </x-h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-button color="danger">
        <span x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
            {{ __('Delete Account') }}
        </span>
    </x-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <x-form method="POST" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-form.input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-form.text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-form.input-error :messages="$errors->userDeletion->get('password')" />
            </div>

            <div class="flex justify-end gap-2">
                <x-button color="secondary" type="button">
                    <span x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </span>
                </x-button>

                <x-button color="danger">
                    {{ __('Delete Account') }}
                </x-button>
            </div>
        </x-form>
    </x-modal>
</section>
