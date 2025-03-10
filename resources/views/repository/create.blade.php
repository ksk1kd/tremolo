<x-app-layout>
    <x-slot name="title">
        {{ __('Create New Repository') }}
    </x-slot>

    <x-slot name="content">
        <x-form
            action="{{ route('repository.store') }}"
            method="post"
            x-data="{
                id: '',
                name: '',
                convert() {
                    this.name = (this.id.charAt(0).toUpperCase() + this.id.slice(1)).replace(/-/g, ' ');
                },
            }"
        >
            @csrf

            <div>
                <x-form.input-label for="id" :value="__('ID')" />
                <x-form.text-input
                    id="id"
                    name="id"
                    type="text"
                    :value="old('id')"
                    :placeholder="__('my-repo')"
                    required
                    autocomplete="off"
                    x-model="id"
                    x-on:input.change="convert"
                />
                <x-form.input-error :messages="$errors->get('id')" />
            </div>

            <div>
                <x-form.input-label for="name" :value="__('Name')" />
                <x-form.text-input
                    id="name"
                    name="name"
                    type="text"
                    :value="old('name')"
                    :placeholder="__('My repo')"
                    required
                    autocomplete="off"
                    x-model="name"
                />
                <x-form.input-error :messages="$errors->get('name')" />
            </div>

            <x-button>
                {{ __('Create') }}
            </x-button>
        </x-form>
    </x-slot>
</x-app-layout>
