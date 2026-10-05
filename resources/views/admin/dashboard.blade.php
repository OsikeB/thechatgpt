@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
<section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <div>
        <p class="text-sm font-bold uppercase tracking-wider text-blue-600">Administration</p>
        <h1 class="text-3xl font-extrabold tracking-tight text-slate-950">Dashboard</h1>
        <p class="mt-2 text-slate-600">Manage content, users, media, and publishing workflows.</p>
    </div>
    <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ([['icon'=>'fa-newspaper','label'=>'Articles'],['icon'=>'fa-users','label'=>'Authors'],['icon'=>'fa-layer-group','label'=>'Categories'],['icon'=>'fa-tags','label'=>'Tags']] as $card)
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <i class="fa-solid {{ $card['icon'] }} text-blue-600" aria-hidden="true"></i>
                <p class="mt-5 text-sm font-medium text-slate-500">{{ $card['label'] }}</p>
                <p class="mt-1 text-3xl font-extrabold text-slate-950">0</p>
            </div>
        @endforeach
    </div>
    <div class="mt-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h2 class="text-lg font-bold text-slate-950">Next build stage</h2>
        <p class="mt-2 text-sm leading-6 text-slate-600">Authentication, roles/permissions, article management, media management, audit logging, and hardened admin workflows are next.</p>
    </div>
</section>
@endsection