@extends('layouts.app')

@section('title', 'Technology, explained clearly')

@section('content')
<section class="overflow-hidden bg-slate-950">
    <div class="mx-auto grid max-w-7xl gap-12 px-4 py-20 sm:px-6 lg:grid-cols-2 lg:items-center lg:px-8 lg:py-28">
        <div>
            <span class="inline-flex items-center gap-2 rounded-full border border-blue-400/30 bg-blue-400/10 px-3 py-1 text-sm font-semibold text-blue-200">
                <i class="fa-solid fa-bolt" aria-hidden="true"></i> Modern Technology CMS
            </span>
            <h1 class="mt-6 text-4xl font-extrabold tracking-tight text-white sm:text-6xl">Technology, explained clearly.</h1>
            <p class="mt-6 max-w-xl text-lg leading-8 text-slate-300">A fast, accessible publishing platform for thoughtful technology stories, engineering insights, and practical guides.</p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('posts.index') }}" class="rounded-xl bg-blue-600 px-5 py-3 font-semibold text-white shadow-lg shadow-blue-950/30 hover:bg-blue-500">Explore articles</a>
                <a href="#featured" class="rounded-xl border border-white/20 px-5 py-3 font-semibold text-white hover:bg-white/10">Featured</a>
            </div>
        </div>
        <div class="rounded-3xl border border-white/10 bg-white/5 p-6 shadow-2xl">
            <div class="grid gap-4 sm:grid-cols-2">
                <div class="rounded-2xl bg-white/10 p-5">
                    <i class="fa-solid fa-shield-halved text-xl text-blue-300" aria-hidden="true"></i>
                    <h2 class="mt-4 font-bold text-white">Secure by default</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-300">Built around strong validation, authorization, and safe defaults.</p>
                </div>
                <div class="rounded-2xl bg-white/10 p-5">
                    <i class="fa-solid fa-gauge-high text-xl text-blue-300" aria-hidden="true"></i>
                    <h2 class="mt-4 font-bold text-white">Performance focused</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-300">Designed for responsive pages and efficient database access.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="featured" class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="flex items-end justify-between gap-6">
        <div>
            <p class="text-sm font-bold uppercase tracking-wider text-blue-600">The platform</p>
            <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-950">Built for serious publishing</h2>
        </div>
        <a href="{{ route('posts.index') }}" class="hidden text-sm font-bold text-blue-600 sm:block">View all articles →</a>
    </div>
</section>
@endsection