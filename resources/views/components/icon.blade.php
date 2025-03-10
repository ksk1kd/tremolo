@props([
    'icon',
    'color' => 'text-slate-600',
    'size' => null,
])

<i class="material-icons {{ $color }} {{ $size }}">{{ $icon }}</i>
