@extends('layouts.app')

@section('title', 'New Article')

@section('content')
<section class="mx-auto max-w-4xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="mb-8">
        <a href="{{ route('admin.posts.index') }}" class="text-sm font-bold text-blue-700 hover:underline"><i class="fa-solid fa-arrow-left mr-1" aria-hidden="true"></i> Articles</a>
        <h1 class="mt-4 text-3xl font-extrabold tracking-tight text-slate-950">New article</h1>
    </div>
    @include('admin.posts.form', ['action' => route('admin.posts.store'), 'method' => 'POST', 'submitLabel' => 'Create article'])
</section>
@endsection
