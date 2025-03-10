<x-app-layout>
    <x-slot name="title">
        {{ __('Workspace') }}
    </x-slot>

    <x-slot name="content">
        <x-link-button :href="route('branch.create', ['repository' => $repository])" :text="__('Create')" />
        <div class="h-6"></div>
        <x-table :headers="[__('Name'), __('Operation')]" :zero-text="__('No Workspaces')">
            @foreach ($branches as $branch)
                <x-table.tr>
                    <x-table.td>
                        <a
                            class="py-4"
                            href="{{ route('branch.show', ['repository' => $repository, 'branch' => $branch->id]) }}"
                        >
                            {{ $branch->name }}
                        </a>
                    </x-table.td>
                    <x-table.td>
                        <x-form
                            class="inline-block"
                            action="{{ route('branch.destroy', ['repository' => $repository, 'branch' => $branch->id]) }}"
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
