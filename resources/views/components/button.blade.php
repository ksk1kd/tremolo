@props([
    'color' => 'primary',
    'type' => 'submit',
])

@php
    switch ($color) {
        case 'danger':
            $classes[] = 'bg-red-500';
            $classes[] = 'text-white';
            break;
        case 'secondary':
            $classes[] = 'bg-white';
            $classes[] = 'text-black';
            $classes[] = 'border-slate-600';
            break;
        case 'primary':
        default:
            $classes[] = 'bg-slate-600';
            $classes[] = 'text-white';
            break;
    }
@endphp

<button class="{{ implode(' ', $classes) }} inline-block rounded-full border px-6 py-2 text-base" type="{{ $type }}">
    {{ $slot }}
</button>
