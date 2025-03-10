<x-app-layout>
    <x-slot name="title">
        {{ __('History') }}
    </x-slot>

    <x-slot name="content">
        <x-table :headers="[__('Date'), __('Message'), __('User'), __('ID')]" :zero-text="__('No History')">
            @foreach ($history as $commit)
                <x-table.tr>
                    <x-table.td :nowrap="true">
                        {{ $commit['date'] }}
                    </x-table.td>
                    <x-table.td>
                        {{ $commit['message'] }}
                    </x-table.td>
                    <x-table.td :nowrap="true">
                        {{ $commit['user'] }}
                    </x-table.td>
                    <x-table.td :nowrap="true">
                        {{ $commit['hash'] }}
                    </x-table.td>
                </x-table.tr>
            @endforeach
        </x-table>
    </x-slot>
</x-app-layout>
