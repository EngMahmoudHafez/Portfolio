<?php

namespace App\Http\Controllers;

use App\Repositories\ProjectRepository;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function __construct(
        protected ProjectRepository $projectRepo,
    ) {}

    public function index(Request $request): View
    {
        $category = $request->get('category');
        $search = $request->get('search');

        if ($search) {
            $projects = $this->projectRepo->search($search);
        } elseif ($category) {
            $projects = $this->projectRepo->getByCategory($category);
        } else {
            $projects = $this->projectRepo->getActive();
        }

        return view('projects.index', [
            'projects' => $projects,
            'categories' => Category::active()->ofType('project')->get(),
            'currentCategory' => $category,
            'search' => $search,
        ]);
    }

    public function show(Project $project): View
    {
        abort_unless($project->is_active, 404);
        return view('projects.show', compact('project'));
    }
}
