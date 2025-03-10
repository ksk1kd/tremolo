<table class="w-full rounded border">
    @isset($headers)
        <thead class="bg-slate-200">
            <tr class="px-6 py-4">
                @foreach ($headers as $head)
                    <th class="px-4 py-1 text-left font-normal">
                        {{ $head }}
                    </th>
                @endforeach
            </tr>
        </thead>
    @endisset

    <tbody>
        @if ($slot->isNotEmpty())
            {!! $slot !!}
        @else
            <x-table.tr>
                <x-table.td>{{ $zeroText }}</x-table.td>
            </x-table.tr>
        @endif
    </tbody>
</table>
