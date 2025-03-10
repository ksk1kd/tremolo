<x-page-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <x-slot name="content">
        @php
            $route = Route::current()->getName();
        @endphp

        <div class="mx-auto flex min-h-screen max-w-6xl gap-12 pb-12 pt-8">
            <aside class="w-56 border-r border-gray-300 pr-2">
                <a
                    class="flex items-center gap-2 text-2xl"
                    href="{{ route($route, ['repository' => $repository, 'branch' => $branch ?? null, 'path' => 'index.md']) }}"
                >
                    <x-icon icon="home" size="text-3xl" />
                    Home
                </a>

                <nav class="mt-6">
                    @isset($parent)
                        <a
                            class="mb-4 mr-4 block border-b border-gray-300 p-2"
                            href="{{ route($route, ['repository' => $repository, 'branch' => $branch ?? null, 'path' => $parent['path']]) }}"
                        >
                            {{ $parent['title'] }}
                        </a>
                    @endisset

                    @isset($navs)
                        <ul>
                            @foreach ($navs as $nav)
                                <li>
                                    <a
                                        class="flex items-center gap-1 p-2 pl-0"
                                        href="{{ route($route, ['repository' => $repository, 'branch' => $branch ?? null, 'path' => $nav['path']]) }}"
                                    >
                                        <x-icon
                                            icon="arrow_right"
                                            color="{{ $path === $nav['path'] ? 'text-red-500' : 'text-gray-400' }}"
                                        />
                                        {{ $nav['title'] }}
                                    </a>
                                    @isset($nav['children'])
                                        <ul>
                                            @foreach ($nav['children'] as $child)
                                                <li>
                                                    <a
                                                        class="ml-4 flex items-center gap-1 p-2 pl-0"
                                                        href="{{ route($route, ['repository' => $repository, 'branch' => $branch ?? null, 'path' => $child['path']]) }}"
                                                    >
                                                        <x-icon
                                                            icon="arrow_right"
                                                            color="{{ $path === $child['path'] ? 'text-red-500' : 'text-gray-400' }}"
                                                        />
                                                        {{ $child['title'] }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endisset
                                </li>
                            @endforeach
                        </ul>
                    @endisset
                </nav>
            </aside>
            <main class="flex-1">
                <div
                    x-data="{
                        body: '{{ str_replace(["\r\n", "\n", "\r"], '\\n', $content) }}',
                        markdown: '',
                        preview() {
                            this.markdown = window.marked(this.body)
                        },
                    }"
                    x-effect="preview"
                >
                    <x-html-renderer><div x-html="markdown"></div></x-html-renderer>
                </div>
            </main>
        </div>
    </x-slot>
</x-page-layout>
