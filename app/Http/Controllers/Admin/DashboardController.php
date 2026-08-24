<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\TeamMember;
use App\Models\Contact;
use App\Models\Post;
use App\Models\Newsletter;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Testimonial;
use App\Models\Setting;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'totalProjects' => Project::count(),
            'totalTeamMembers' => TeamMember::count(),
            'totalContacts' => Contact::count(),
            'unreadContacts' => Contact::unread()->count(),
            'totalPosts' => Post::count(),
            'publishedPosts' => Post::published()->count(),
            'totalSubscribers' => Newsletter::where('is_active', true)->count(),
            'recentContacts' => Contact::latest()->limit(5)->get(),
            'recentPosts' => Post::latest()->limit(5)->get(),

            // Maps each public homepage section to the data actually behind it,
            // so it is obvious which sections are live, falling back, or hidden.
            'frontendSections' => $this->frontendSections(),
        ]);
    }

    /**
     * @return array<int, array{label: string, count: int, route: ?string, empty: string}>
     */
    protected function frontendSections(): array
    {
        $statsSet = collect(['stat_projects', 'stat_clients', 'stat_years'])
            ->filter(fn ($key) => filled(Setting::get($key)))
            ->count();

        return [
            [
                'label' => 'Hero stats',
                'count' => $statsSet,
                'route' => route('admin.settings.index'),
                'empty' => 'hidden',
            ],
            [
                'label' => 'Services',
                'count' => Service::where('is_active', true)->count(),
                'route' => route('admin.services.index'),
                'empty' => 'built-in fallback',
            ],
            [
                'label' => 'Team',
                'count' => TeamMember::where('is_active', true)->count(),
                'route' => route('admin.team.index'),
                'empty' => 'built-in fallback',
            ],
            [
                'label' => 'Featured projects',
                'count' => Project::where('is_active', true)->where('is_featured', true)->count(),
                'route' => route('admin.projects.index'),
                'empty' => 'empty state',
            ],
            [
                'label' => 'Skills',
                'count' => Skill::where('is_active', true)->count(),
                'route' => route('admin.skills.index'),
                'empty' => 'built-in fallback',
            ],
            [
                'label' => 'Testimonials',
                'count' => Testimonial::where('is_active', true)->count(),
                'route' => route('admin.testimonials.index'),
                'empty' => 'hidden',
            ],
            [
                'label' => 'Blog posts',
                'count' => Post::published()->count(),
                'route' => route('admin.posts.index'),
                'empty' => 'empty state',
            ],
            [
                'label' => 'Contact details',
                'count' => collect(['contact_email', 'contact_phone', 'contact_address'])
                    ->filter(fn ($key) => filled(Setting::get($key)))
                    ->count(),
                'route' => route('admin.settings.index'),
                'empty' => 'hidden',
            ],
            [
                'label' => 'WhatsApp button',
                'count' => filled(Setting::get('whatsapp_number')) ? 1 : 0,
                'route' => route('admin.settings.index'),
                'empty' => 'hidden',
            ],
        ];
    }
}
