<x-app-layout>
    <x-slot name="title">
        {{ __('Edit File') }}
    </x-slot>

    <x-slot name="content">
        <x-file.editor
            operation="edit"
            :repository="$repository"
            :branch="$branch"
            :path="$path"
            :content="$content"
        />
    </x-slot>
</x-app-layout>
