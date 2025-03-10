@props([
    'operation',
    'repository',
    'branch',
    'path' => null,
    'content' => null,
])

<x-form
    class="flex h-full flex-col items-start justify-between gap-4"
    action="{{ route('file.store', ['repository' => $repository, 'branch' => $branch]) }}"
    method="post"
>
    @csrf
    @if ($operation === 'edit')
        @method('put')
        <input type="hidden" name="old" value="{{ $path }}" />
    @endif

    <input
        class="w-full border-none p-0 text-3xl focus:ring-0"
        type="text"
        name="path"
        placeholder="dirname/filename.md"
        value="{{ $path }}"
    />
    <div class="w-full flex-1 overflow-auto">
        <x-file.preview :content="$content" />
    </div>
    @if ($operation === 'create')
        <x-button>
            {{ __('Create') }}
        </x-button>
    @elseif ($operation === 'edit')
        <x-button>
            {{ __('Done') }}
        </x-button>
    @endif
</x-form>
