@extends('layouts.app')

@section('title', 'Manage Articles')

@section('content')
<section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-bold uppercase tracking-wider text-blue-600">Content</p>
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-950">Articles</h1>
            <p class="mt-2 text-slate-600">Create, review, schedule, publish, and archive content.</p>
        </div>
        <a href="{{ route('admin.posts.create') }}" class="inline-flex min-h-11 items-center justify-center gap-2 rounded-xl bg-slate-950 px-5 text-sm font-bold text-white hover:bg-slate-800">
            <i class="fa-solid fa-plus" aria-hidden="true"></i> New article
        </a>
    </div>

    @if (session('status'))
        <div role="status" class="mt-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm font-medium text-emerald-800">{{ session('status') }}</div>
    @endif

    <div class="mt-8 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <caption class="sr-only">Articles</caption>
                <thead class="border-b border-slate-200 bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                    <tr>
                        <th scope="col" class="px-5 py-4">Title</th>
                        <th scope="col" class="px-5 py-4">Status</th>
                        <th scope="col" class="px-5 py-4">Author</th>
                        <th scope="col" class="px-5 py-4">Updated</th>
                        <th scope="col" class="px-5 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($posts as $post)
                        <tr>
                            <td class="px-5 py-4">
                                <div class="font-bold text-slate-950">{{ $post->title }}</div>
                                <div class="mt-1 text-xs text-slate-500">/{{ $post->slug }}</div>
                            </td>
                            <td class="px-5 py-4"><span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-bold uppercase text-slate-700">{{ $post->status }}</span></td>
                            <td class="px-5 py-4 text-slate-600">{{ $post->author->name }}</td>
                            <td class="px-5 py-4 text-slate-600">{{ $post->updated_at->format('M j, Y') }}</td>
                            <td class="px-5 py-4">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.posts.edit', $post) }}" class="inline-flex min-h-10 items-center gap-2 rounded-lg border border-slate-300 px-3 font-bold text-slate-700 hover:bg-slate-50">
                                        <i class="fa-solid fa-pen" aria-hidden="true"></i><span>Edit</span>
                                    </a>
                                    <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" onsubmit="return confirm('Delete this article permanently?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex min-h-10 items-center gap-2 rounded-lg border border-red-200 px-3 font-bold text-red-700 hover:bg-red-50">
                                            <i class="fa-solid fa-trash" aria-hidden="true"></i><span>Delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-5 py-12 text-center text-slate-500">No articles yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($posts->hasPages())
            <div class="border-t border-slate-200 p-5">{{ $posts->links() }}</div>
        @endif
    </div>
</section>
@endsection
