<x-app-layout>
    <x-slot name="title">
        {{ __('Create New File') }}
    </x-slot>

    <x-slot name="content">
        <x-file.editor operation="create" :repository="$repository" :branch="$branch" />
    </x-slot>
</x-app-layout>
