<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Services\ImageService;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostController extends Controller
{
    public function __construct(protected ImageService $imageService) {}

    public function index(): View
    {
        $posts = Post::with(['user', 'category'])->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create(): View
    {
        $categories = Category::active()->ofType('blog')->get();
        $tags = Tag::all();
        return view('admin.posts.form', compact('categories', 'tags'));
    }

    public function store(PostRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);
        $data['user_id'] = auth()->id();
        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $this->imageService->upload($request->file('cover_image'), 'posts');
        }
        $post = Post::create($data);
        if (!empty($data['tags'])) {
            $post->tags()->sync($data['tags']);
        }
        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');
    }

    public function edit(Post $post): View
    {
        $categories = Category::active()->ofType('blog')->get();
        $tags = Tag::all();
        return view('admin.posts.form', compact('post', 'categories', 'tags'));
    }

    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $data = $request->validated();
        if ($data['status'] === 'published' && !$post->published_at && empty($data['published_at'])) {
            $data['published_at'] = now();
        }
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $this->imageService->replace($post->cover_image, $request->file('cover_image'), 'posts');
        }
        $post->update($data);
        if (isset($data['tags'])) {
            $post->tags()->sync($data['tags']);
        }
        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $this->imageService->delete($post->cover_image);
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully.');
    }
}
