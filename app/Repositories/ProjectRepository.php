<?php

namespace App\Repositories;

use App\Models\Project;
use Illuminate\Pagination\LengthAwarePaginator;

class ProjectRepository extends BaseRepository
{
    public function __construct(Project $model)
    {
        parent::__construct($model);
    }

    public function getActive(int $perPage = 9): LengthAwarePaginator
    {
        return $this->model->active()->ordered()->with('category')->paginate($perPage);
    }

    public function getFeatured(int $limit = 6)
    {
        return $this->model->active()->featured()->ordered()->with('category')->limit($limit)->get();
    }

    public function getByCategory(int $categoryId, int $perPage = 9): LengthAwarePaginator
    {
        return $this->model->active()->where('category_id', $categoryId)->ordered()->with('category')->paginate($perPage);
    }

    public function search(string $query, int $perPage = 9): LengthAwarePaginator
    {
        return $this->model->active()
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->ordered()
            ->with('category')
            ->paginate($perPage);
    }
}
