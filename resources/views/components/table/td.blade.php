@props(['nowrap' => false])

<td class="{{ $nowrap ? 'whitespace-nowrap' : '' }} px-4 py-3">
    {!! $slot !!}
</td>
