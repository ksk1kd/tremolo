<x-app-layout>
    <x-slot name="title">
        {{ $path }}
    </x-slot>

    <x-slot name="aux">
        <x-link-button
            :href="route('file.edit', ['repository' => $repository, 'branch' => $branch, 'path' => $path])"
            :text="__('Edit')"
        />
        <x-link-button
            :href="route('page.show', ['repository' => $repository, 'branch' => $branch, 'path' => $path])"
            target="_blank"
            :text="__('Preview')"
        />
    </x-slot>

    <x-slot name="content">
        <div class="flex h-full flex-col items-start gap-6">
            <div class="w-full flex-1 overflow-auto">
                <x-file.preview :content="$content" disabled="true" />
            </div>
        </div>
    </x-slot>
</x-app-layout>
