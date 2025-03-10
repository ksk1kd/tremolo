<x-app-layout>
    <x-slot name="title">
        {{ $name }}
    </x-slot>

    <x-slot name="content">
        <x-table :headers="[__('File')]" :zero-text="__('No Contents')">
            @foreach ($files as $file)
                <x-table.tr>
                    <x-table.td>
                        <a href="{{ route('file.master', ['repository' => $id, 'path' => $file]) }}" class="py-4">
                            {{ $file }}
                        </a>
                    </x-table.td>
                </x-table.tr>
            @endforeach
        </x-table>
    </x-slot>
</x-app-layout>
