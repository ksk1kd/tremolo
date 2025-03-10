<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="flex">
        @include('layouts.navigation')
        <main class="flex h-screen flex-1 flex-col px-10 py-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-12">
                    @isset($title)
                        <h1 class="text-4xl font-medium">{{ $title }}</h1>
                    @endisset

                    @isset($aux)
                        <div>{{ $aux }}</div>
                    @endisset
                </div>
                <div>
                    @include('layouts.account')
                </div>
            </div>
            <div class="mt-8 flex-1 overflow-y-scroll">
                {{ $content }}
            </div>
        </main>
    </body>
</html>
