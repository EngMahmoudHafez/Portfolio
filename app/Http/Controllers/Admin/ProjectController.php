<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProjectRequest;
use App\Models\Project;
use App\Models\Category;
use App\Services\ImageService;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function __construct(protected ImageService $imageService) {}

    public function index(): View
    {
        $projects = Project::with('category')->ordered()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create(): View
    {
        $categories = Category::active()->ofType('project')->get();
        return view('admin.projects.form', compact('categories'));
    }

    public function store(ProjectRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $this->imageService->upload($request->file('cover_image'), 'projects');
        }
        if ($request->hasFile('gallery')) {
            $gallery = [];
            foreach ($request->file('gallery') as $image) {
                $gallery[] = $this->imageService->upload($image, 'projects/gallery');
            }
            $data['gallery'] = $gallery;
        }
        Project::create($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project): View
    {
        $categories = Category::active()->ofType('project')->get();
        return view('admin.projects.form', compact('project', 'categories'));
    }

    public function update(ProjectRequest $request, Project $project): RedirectResponse
    {
        $data = $request->validated();
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $this->imageService->replace($project->cover_image, $request->file('cover_image'), 'projects');
        }
        if ($request->hasFile('gallery')) {
            if ($project->gallery) {
                foreach ($project->gallery as $oldImage) {
                    $this->imageService->delete($oldImage);
                }
            }
            $gallery = [];
            foreach ($request->file('gallery') as $image) {
                $gallery[] = $this->imageService->upload($image, 'projects/gallery');
            }
            $data['gallery'] = $gallery;
        }
        $project->update($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $this->imageService->delete($project->cover_image);
        if ($project->gallery) {
            foreach ($project->gallery as $image) {
                $this->imageService->delete($image);
            }
        }
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }
}
