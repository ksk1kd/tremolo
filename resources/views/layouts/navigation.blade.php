<nav class="h-screen w-48 bg-slate-200 px-6 py-4 drop-shadow-xl">
    <div class="text-2xl font-extrabold"><a href="/">Tremolo</a></div>

    @if (session('repository_id'))
        <div class="mt-8 text-xl font-bold">
            <a class="flex gap-2" href="{{ route('repository.show', ['repository' => session('repository_id')]) }}">
                <x-icon icon="inventory" />
                {{ session('repository_name') }}
            </a>
        </div>
        <ul class="mt-4">
            <li>
                <a
                    class="inline-block py-2"
                    href="{{ route('repository.show', ['repository' => session('repository_id')]) }}"
                >
                    {{ __('Content') }}
                </a>
            </li>
            <li>
                <a
                    class="inline-block py-2"
                    href="{{ route('branch.index', ['repository' => session('repository_id')]) }}"
                >
                    {{ __('Workspace') }}
                </a>
            </li>
            <li>
                <a
                    class="inline-block py-2"
                    href="{{ route('history.index', ['repository' => session('repository_id')]) }}"
                >
                    {{ __('History') }}
                </a>
            </li>
        </ul>
    @else
        <ul class="mt-8">
            <li>
                <a class="inline-block py-2" href="{{ route('repository.index') }}">
                    {{ __('Repository') }}
                </a>
            </li>
        </ul>
    @endif
</nav>
