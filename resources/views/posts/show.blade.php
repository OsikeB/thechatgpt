@extends('layouts.app')
@section('title', $post->seo_title ?: $post->title)
@section('meta_description', $post->seo_description ?: $post->excerpt)
@section('content')
<article class="mx-auto max-w-4xl px-4 py-14 sm:px-6 lg:px-8">
    <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-blue-600"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Back to articles</a>
    <header class="mt-8">
        <p class="text-sm font-bold uppercase tracking-wider text-blue-600">{{ $post->category?->name ?? 'Technology' }}</p>
        <h1 class="mt-3 text-4xl font-extrabold tracking-tight text-slate-950 sm:text-5xl">{{ $post->title }}</h1>
        @if ($post->excerpt)<p class="mt-6 text-xl leading-8 text-slate-600">{{ $post->excerpt }}</p>@endif
        <div class="mt-6 flex items-center gap-3 text-sm text-slate-500">
            <span>By {{ $post->author->name }}</span><span aria-hidden="true">•</span>
            <time datetime="{{ $post->published_at?->toAtomString() }}">{{ $post->published_at?->format('M j, Y') }}</time>
        </div>
    </header>
    <div class="prose-cms mt-12">{!! $post->body !!}</div>
</article>
@endsection