<?php

namespace App\Http\Controllers;

use App\Repositories\ServiceRepository;
use App\Repositories\TeamMemberRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\SkillRepository;
use App\Repositories\TestimonialRepository;
use App\Repositories\PostRepository;
use App\Models\Category;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        protected ServiceRepository $serviceRepo,
        protected TeamMemberRepository $teamRepo,
        protected ProjectRepository $projectRepo,
        protected SkillRepository $skillRepo,
        protected TestimonialRepository $testimonialRepo,
        protected PostRepository $postRepo,
    ) {}

    public function index(): View
    {
        return view('home', [
            'services' => $this->serviceRepo->getActive(),
            'team' => $this->teamRepo->getActive(),
            'projects' => $this->projectRepo->getFeatured(6),
            'skills' => $this->skillRepo->getActive(),
            'testimonials' => $this->testimonialRepo->getActive(),
            'posts' => $this->postRepo->getRecent(3),
            'projectCategories' => Category::active()->ofType('project')->get(),
        ]);
    }
}
