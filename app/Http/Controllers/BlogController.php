<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepository;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function __construct(
        protected PostRepository $postRepo,
    ) {}

    public function index(Request $request): View
    {
        $category = $request->get('category');
        $tag = $request->get('tag');
        $search = $request->get('search');

        if ($search) {
            $posts = $this->postRepo->search($search);
        } elseif ($category) {
            $posts = $this->postRepo->getByCategory($category);
        } elseif ($tag) {
            $posts = $this->postRepo->getByTag($tag);
        } else {
            $posts = $this->postRepo->getPublished();
        }

        return view('blog.index', [
            'posts' => $posts,
            'categories' => Category::active()->ofType('blog')->get(),
            'tags' => Tag::all(),
            'currentCategory' => $category,
            'currentTag' => $tag,
            'search' => $search,
        ]);
    }

    public function show(string $slug): View
    {
        $post = $this->postRepo->findBySlug($slug);
        $this->postRepo->incrementViews($post);

        $relatedPosts = $post->category
            ? $this->postRepo->getByCategory($post->category_id, 3)
            : collect();

        return view('blog.show', compact('post', 'relatedPosts'));
    }
}
