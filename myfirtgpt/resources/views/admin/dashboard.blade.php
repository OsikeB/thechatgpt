@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-bold uppercase tracking-wider text-blue-600">Administration</p>
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-950">Dashboard</h1>
            <p class="mt-2 text-slate-600">Manage content and publishing workflows.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.posts.create') }}" class="inline-flex min-h-11 items-center gap-2 rounded-xl bg-slate-950 px-5 text-sm font-bold text-white hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2">
                <i class="fa-solid fa-plus" aria-hidden="true"></i> New article
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="inline-flex min-h-11 items-center gap-2 rounded-xl border border-slate-300 bg-white px-5 text-sm font-bold text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2">
                    <i class="fa-solid fa-right-from-bracket" aria-hidden="true"></i> Sign out
                </button>
            </form>
        </div>
    </div>

    @if (session('status'))
        <div role="status" class="mt-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm font-medium text-emerald-800">
            {{ session('status') }}
        </div>
    @endif

    <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
        <a href="{{ route('admin.posts.index') }}" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
            <i class="fa-solid fa-newspaper text-blue-600" aria-hidden="true"></i>
            <p class="mt-5 text-sm font-medium text-slate-500">Articles</p>
            <p class="mt-1 text-3xl font-extrabold text-slate-950">{{ \App\Models\Post::count() }}</p>
        </a>
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <i class="fa-solid fa-users text-blue-600" aria-hidden="true"></i>
            <p class="mt-5 text-sm font-medium text-slate-500">Authors</p>
            <p class="mt-1 text-3xl font-extrabold text-slate-950">{{ \App\Models\User::where('is_admin', true)->count() }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <i class="fa-solid fa-layer-group text-blue-600" aria-hidden="true"></i>
            <p class="mt-5 text-sm font-medium text-slate-500">Categories</p>
            <p class="mt-1 text-3xl font-extrabold text-slate-950">{{ \App\Models\Category::count() }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <i class="fa-solid fa-tags text-blue-600" aria-hidden="true"></i>
            <p class="mt-5 text-sm font-medium text-slate-500">Tags</p>
            <p class="mt-1 text-3xl font-extrabold text-slate-950">{{ \App\Models\Tag::count() }}</p>
        </div>
    </div>
</section>
@endsection
