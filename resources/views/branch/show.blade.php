<x-app-layout>
    <x-slot name="title">
        {{ $name }}
    </x-slot>

    <x-slot name="aux">
        <x-form
            method="POST"
            action="{{ route('merge.store', ['repository' => $repository, 'branch' => $id]) }}"
            class="inline-block"
        >
            @csrf

            <button type="submit" class="inline-flex items-center gap-1">
                <x-icon icon="merge" color="text-red-500 font-bold" size="text-2xl" />
                <span class="text-xl font-bold text-red-500">{{ __('Merge') }}</span>
            </button>
        </x-form>
    </x-slot>

    <x-slot name="content">
        <x-link-button
            :href="route('file.create', ['repository' => $repository, 'branch' => $id])"
            :text="__('Create')"
        />
        <div class="h-6"></div>
        <x-table :headers="[__('File'), __('Operation')]" :zero-text="__('No Contents')">
            @foreach ($files as $file)
                <x-table.tr>
                    <x-table.td>
                        <a
                            href="{{ route('file.show', ['repository' => $repository, 'branch' => $id, 'path' => $file]) }}"
                            class="py-4"
                        >
                            {{ $file }}
                        </a>
                    </x-table.td>
                    <x-table.td>
                        <a
                            class="py-4"
                            href="{{ route('file.edit', ['repository' => $repository, 'branch' => $id, 'path' => $file]) }}"
                        >
                            <x-icon icon="edit" />
                        </a>
                        <x-form
                            class="inline-block"
                            action="{{ route('file.destroy', ['repository' => $repository, 'branch' => $id]) }}"
                            method="post"
                        >
                            @method('delete')
                            @csrf
                            <input type="hidden" name="path" value="{{ $file }}" />
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
