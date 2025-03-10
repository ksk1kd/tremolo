@props([
    'content',
    'disabled' => false,
])

<div
    x-data="{
        body: '{{ str_replace(["\r\n", "\n", "\r"], '\\n', $content) }}',
        markdown: '',
        preview() {
            this.markdown = window.marked(this.body)
        },
    }"
    x-effect="preview"
    class="flex h-full w-full gap-2"
>
    <textarea
        x-model="body"
        class="{{ $disabled ? 'bg-slate-50 text-slate-500' : '' }} block w-1/2 resize-none overflow-y-scroll border-none p-6 focus:ring-0"
        name="body"
        placeholder="# title"
        @disabled($disabled)
    ></textarea>
    <div class="flex w-1/2 flex-col border border-slate-300">
        <span class="bg-slate-300 px-2 py-1 text-xs text-slate-900">Preview</span>
        <div class="flex-1 overflow-y-scroll px-6 pb-6 pt-2">
            <x-html-renderer><div x-html="markdown"></div></x-html-renderer>
        </div>
    </div>
</div>
