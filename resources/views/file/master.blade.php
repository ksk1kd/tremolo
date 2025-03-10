<x-app-layout>
    <x-slot name="title">
        {{ $path }}
    </x-slot>

    <x-slot name="aux">
        <x-link-button
            :href="route('page.master', ['repository' => $repository, 'path' => $path])"
            target="_blank"
            :text="__('Preview')"
        />
    </x-slot>

    <x-slot name="content">
        <x-file.preview :content="$content" disabled="true" />
    </x-slot>
</x-app-layout>
