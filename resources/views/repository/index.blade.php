<x-app-layout>
    <x-slot name="title">
        {{ __('Repository') }}
    </x-slot>

    <x-slot name="content">
        <x-link-button :href="route('repository.create')" :text="__('Create')" />
        <div class="h-6"></div>
        <x-table :headers="[__('Name'), __('Operation')]" :zero-text="__('No Repositories')">
            @foreach ($repositories as $repository)
                <x-table.tr>
                    <x-table.td>
                        <a href="{{ route('repository.show', ['repository' => $repository->id]) }}" class="py-4">
                            {{ $repository->name }}
                        </a>
                    </x-table.td>
                    <x-table.td>
                        <x-form
                            class="inline-block"
                            action="{{ route('repository.destroy', ['repository' => $repository->id]) }}"
                            method="post"
                        >
                            @method('delete')
                            @csrf
                            <button type="submit" class="inline-flex h-8 items-center">
                                <x-icon icon="delete" />
                            </button>
                        </x-form>
                    </x-table.td>
                </x-table.tr>
            @endforeach
        </x-table>
    </x-slot>
</x-app-layout>
