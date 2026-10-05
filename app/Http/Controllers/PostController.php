<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

final class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::query()
            ->published()
            ->with(['author', 'category'])
            ->latest('published_at')
            ->paginate(12);

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post): View
    {
        abort_unless($post->isPublished(), 404);

        $post->load(['author', 'category', 'tags']);

        return view('posts.show', compact('post'));
    }
}