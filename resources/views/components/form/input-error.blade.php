@props([
    'messages',
])

@if ($messages)
    <ul class="mt-2 space-y-1 text-sm text-red-600">
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
