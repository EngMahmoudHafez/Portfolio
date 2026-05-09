<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

class PostRepository extends BaseRepository
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    public function getPublished(int $perPage = 9): LengthAwarePaginator
    {
        return $this->model->published()->latest('published_at')->with(['user', 'category', 'tags'])->paginate($perPage);
    }

    public function getByCategory(int $categoryId, int $perPage = 9): LengthAwarePaginator
    {
        return $this->model->published()->where('category_id', $categoryId)->latest('published_at')->with(['user', 'category', 'tags'])->paginate($perPage);
    }

    public function getByTag(int $tagId, int $perPage = 9): LengthAwarePaginator
    {
        return $this->model->published()->whereHas('tags', fn($q) => $q->where('tags.id', $tagId))->latest('published_at')->with(['user', 'category', 'tags'])->paginate($perPage);
    }

    public function search(string $query, int $perPage = 9): LengthAwarePaginator
    {
        return $this->model->published()
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('excerpt', 'like', "%{$query}%")
                  ->orWhere('body', 'like', "%{$query}%");
            })
            ->latest('published_at')
            ->with(['user', 'category', 'tags'])
            ->paginate($perPage);
    }

    public function getRecent(int $limit = 3)
    {
        return $this->model->published()->latest('published_at')->with(['user', 'category'])->limit($limit)->get();
    }

    public function findBySlug(string $slug)
    {
        return $this->model->where('slug', $slug)->published()->with(['user', 'category', 'tags'])->firstOrFail();
    }

    public function incrementViews(Post $post): void
    {
        $post->increment('views_count');
    }
}
