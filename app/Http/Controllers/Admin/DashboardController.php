<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\TeamMember;
use App\Models\Contact;
use App\Models\Post;
use App\Models\Newsletter;
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
        ]);
    }
}
