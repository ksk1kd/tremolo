@props(['disabled' => false])

<input
    @disabled($disabled)
    {!! $attributes->merge(['class' => 'block mt-1 mb-6 w-96 border border-slate-300 rounded px-3 py-2 focus:ring-0 focus:border-slate-300']) !!}
/>
