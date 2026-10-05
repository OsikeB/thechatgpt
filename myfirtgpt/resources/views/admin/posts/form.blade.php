@if ($errors->any())
    <div role="alert" class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">
        <p class="font-bold">Please correct the following:</p>
        <ul class="mt-1 list-disc pl-5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
@endif

<form method="POST" action="{{ $action }}" class="space-y-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
    @csrf
    @if ($method !== 'POST') @method($method) @endif

    <div>
        <label for="title" class="block text-sm font-bold text-slate-800">Title</label>
        <input id="title" name="title" value="{{ old('title', $post->title ?? '') }}" required maxlength="200"
            class="mt-2 min-h-12 w-full rounded-xl border border-slate-300 px-4 outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20">
    </div>

    <div>
        <label for="slug" class="block text-sm font-bold text-slate-800">Slug</label>
        <input id="slug" name="slug" value="{{ old('slug', $post->slug ?? '') }}" required maxlength="220" pattern="[A-Za-z0-9_-]+"
            class="mt-2 min-h-12 w-full rounded-xl border border-slate-300 px-4 outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20">
        <p class="mt-1 text-xs text-slate-500">Use letters, numbers, hyphens, or underscores.</p>
    </div>

    <div>
        <label for="excerpt" class="block text-sm font-bold text-slate-800">Excerpt</label>
        <textarea id="excerpt" name="excerpt" rows="3" maxlength="1000" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
    </div>

    <div>
        <label for="body" class="block text-sm font-bold text-slate-800">Article body</label>
        <textarea id="body" name="body" rows="16" required class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 font-mono text-sm outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20">{{ old('body', $post->body ?? '') }}</textarea>
        <p class="mt-1 text-xs text-slate-500">Plain text for now. Rich HTML editing will require an explicit sanitization layer.</p>
    </div>

    <div class="grid gap-6 sm:grid-cols-2">
        <div>
            <label for="category_id" class="block text-sm font-bold text-slate-800">Category</label>
            <select id="category_id" name="category_id" class="mt-2 min-h-12 w-full rounded-xl border border-slate-300 bg-white px-4 outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20">
                <option value="">No category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected((string) old('category_id', $post->category_id ?? '') === (string) $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="status" class="block text-sm font-bold text-slate-800">Status</label>
            <select id="status" name="status" required class="mt-2 min-h-12 w-full rounded-xl border border-slate-300 bg-white px-4 outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20">
                @foreach (['draft','review','scheduled','published','archived'] as $status)
                    <option value="{{ $status }}" @selected(old('status', $post->status ?? 'draft') === $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div>
        <label for="published_at" class="block text-sm font-bold text-slate-800">Publish date/time</label>
        <input id="published_at" name="published_at" type="datetime-local"
            value="{{ old('published_at', isset($post) && $post->published_at ? $post->published_at->format('Y-m-d\\TH:i') : '') }}"
            class="mt-2 min-h-12 w-full rounded-xl border border-slate-300 px-4 outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20">
    </div>

    <div class="grid gap-6 sm:grid-cols-2">
        <div>
            <label for="seo_title" class="block text-sm font-bold text-slate-800">SEO title</label>
            <input id="seo_title" name="seo_title" value="{{ old('seo_title', $post->seo_title ?? '') }}" maxlength="255"
                class="mt-2 min-h-12 w-full rounded-xl border border-slate-300 px-4 outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20">
        </div>
        <div>
            <label for="seo_description" class="block text-sm font-bold text-slate-800">SEO description</label>
            <input id="seo_description" name="seo_description" value="{{ old('seo_description', $post->seo_description ?? '') }}" maxlength="320"
                class="mt-2 min-h-12 w-full rounded-xl border border-slate-300 px-4 outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20">
        </div>
    </div>

    <div class="flex justify-end gap-3 border-t border-slate-200 pt-6">
        <a href="{{ route('admin.posts.index') }}" class="inline-flex min-h-11 items-center rounded-xl border border-slate-300 px-5 font-bold text-slate-700 hover:bg-slate-50">Cancel</a>
        <button type="submit" class="inline-flex min-h-11 items-center gap-2 rounded-xl bg-slate-950 px-5 font-bold text-white hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2">
            <i class="fa-solid fa-floppy-disk" aria-hidden="true"></i> {{ $submitLabel }}
        </button>
    </div>
</form>
