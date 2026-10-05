@extends('layouts.app')
@section('title', 'Articles')
@section('content')
<section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
    <div class="max-w-2xl">
        <p class="text-sm font-bold uppercase tracking-wider text-blue-600">Latest thinking</p>
        <h1 class="mt-2 text-4xl font-extrabold tracking-tight text-slate-950">Articles</h1>
        <p class="mt-4 text-lg leading-8 text-slate-600">Technology stories, engineering lessons, and practical guides.</p>
    </div>
    <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($posts as $post)
            <article class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                @if ($post->featured_image)
                    <img src="{{ Storage::url($post->featured_image) }}" alt="" class="aspect-video w-full object-cover">
                @else
                    <div class="flex aspect-video items-center justify-center bg-slate-900 text-3xl text-blue-300" aria-hidden="true"><i class="fa-solid fa-microchip"></i></div>
                @endif
                <div class="p-6">
                    <p class="text-sm font-semibold text-blue-600">{{ $post->category?->name ?? 'Technology' }}</p>
                    <h2 class="mt-2 text-xl font-bold tracking-tight text-slate-950 group-hover:text-blue-600"><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h2>
                    <p class="mt-3 line-clamp-3 text-sm leading-6 text-slate-600">{{ $post->excerpt }}</p>
                    <p class="mt-5 text-xs font-medium text-slate-500">{{ $post->published_at?->format('M j, Y') }}</p>
                </div>
            </article>
        @empty
            <div class="col-span-full rounded-2xl border border-dashed border-slate-300 bg-white p-12 text-center">
                <i class="fa-regular fa-newspaper text-3xl text-slate-400" aria-hidden="true"></i>
                <h2 class="mt-4 text-lg font-bold">No published articles yet</h2>
                <p class="mt-2 text-sm text-slate-500">Published stories will appear here.</p>
            </div>
        @endforelse
    </div>
    <div class="mt-10">{{ $posts->links() }}</div>
</section>
@endsection