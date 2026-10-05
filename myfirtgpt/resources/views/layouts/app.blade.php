<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', 'A modern technology publishing platform.')">
    <title>@yield('title', config('app.name'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 font-sans text-slate-900">
<a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 focus:rounded-lg focus:bg-white focus:px-4 focus:py-3 focus:shadow-lg">Skip to content</a>
<header x-data="{ open: false }" class="sticky top-0 z-40 border-b border-slate-200 bg-white/95 backdrop-blur">
    <nav class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8" aria-label="Primary navigation">
        <a href="{{ route('home') }}" class="text-xl font-extrabold tracking-tight text-slate-950">MyFirtGPT</a>
        <button type="button" class="rounded-lg p-2 text-slate-700 md:hidden" @click="open = !open" :aria-expanded="open" aria-controls="mobile-navigation" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars" aria-hidden="true"></i>
        </button>
        <div class="hidden items-center gap-6 md:flex">
            <a class="text-sm font-semibold text-slate-700 hover:text-blue-600" href="{{ route('posts.index') }}">Articles</a>
            @auth
                @if (auth()->user()->isAdmin())
                    <a class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700" href="{{ route('admin.dashboard') }}">Admin</a>
                @endif
            @else
                <a class="text-sm font-semibold text-slate-700 hover:text-blue-600" href="{{ route('login') }}">Sign in</a>
            @endauth
        </div>
    </nav>
    <div id="mobile-navigation" x-cloak x-show="open" class="border-t border-slate-200 px-4 py-4 md:hidden">
        <a class="block rounded-lg px-3 py-2 font-medium hover:bg-slate-100" href="{{ route('posts.index') }}">Articles</a>
        @auth
            @if (auth()->user()->isAdmin())
                <a class="mt-1 block rounded-lg px-3 py-2 font-medium hover:bg-slate-100" href="{{ route('admin.dashboard') }}">Admin</a>
            @endif
        @else
            <a class="mt-1 block rounded-lg px-3 py-2 font-medium hover:bg-slate-100" href="{{ route('login') }}">Sign in</a>
        @endauth
    </div>
</header>
<main id="main-content">@yield('content')</main>
<footer class="mt-20 border-t border-slate-200 bg-white">
    <div class="mx-auto max-w-7xl px-4 py-8 text-sm text-slate-500 sm:px-6 lg:px-8">
        © {{ now()->year }} {{ config('app.name') }}. Built with Laravel.
    </div>
</footer>
</body>
</html>