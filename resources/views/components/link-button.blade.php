@props([
    'text',
    'href',
    'target' => '_self',
])

<a class="inline-block rounded-full bg-slate-600 px-6 py-2 text-white" href="{{ $href }}" target="{{ $target }}">
    {{ $text }}
</a>
