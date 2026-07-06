<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Category;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Testimonial;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Setting;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        // Services
        $services = [
            ['title' => 'Web Development', 'icon' => 'fas fa-code', 'icon_color' => '#176BFF', 'description' => 'Custom websites, dashboards, and web applications built with modern technologies and clean architecture.'],
            ['title' => 'Mobile Apps', 'icon' => 'fas fa-mobile-alt', 'icon_color' => '#00C1FF', 'description' => 'Cross-platform mobile applications for Android and iOS with smooth user experiences.'],
            ['title' => 'UI/UX Design', 'icon' => 'fas fa-palette', 'icon_color' => '#6EA8FF', 'description' => 'Modern, intuitive interfaces that improve usability and make products easier to use.'],
            ['title' => 'Branding', 'icon' => 'fas fa-paint-brush', 'icon_color' => '#1673FF', 'description' => 'Consistent digital brand identity assets for websites, apps, social media, and business presentations.'],
            ['title' => 'AI Solutions', 'icon' => 'fas fa-robot', 'icon_color' => '#00C1FF', 'description' => 'Smart automation, AI-powered workflows, and intelligent tools that reduce manual work and improve decisions.'],
            ['title' => 'Backend & Scalable Systems', 'icon' => 'fas fa-server', 'icon_color' => '#176BFF', 'description' => 'Secure APIs, databases, integrations, queues, and backend systems built to scale.'],
        ];
        foreach ($services as $i => $s) {
            Service::create(array_merge($s, ['slug' => Str::slug($s['title']), 'sort_order' => $i]));
        }

        // Team
        $members = [
            ['name' => 'Engineering Team', 'position' => 'Scalable Systems', 'bio' => 'Engineers focused on clean architecture, secure APIs, and reliable product delivery.', 'skills' => ['Laravel', 'React', 'Backend Engineering'], 'social_links' => []],
            ['name' => 'Product Design Team', 'position' => 'UI/UX Strategy', 'bio' => 'Designers shaping intuitive interfaces for websites, apps, dashboards, and automation tools.', 'skills' => ['UI/UX', 'Branding', 'Product Design'], 'social_links' => []],
            ['name' => 'Mobile Team', 'position' => 'Android & iOS Apps', 'bio' => 'Mobile specialists building smooth cross-platform experiences for growing businesses.', 'skills' => ['Mobile Apps', 'React Native', 'Flutter'], 'social_links' => []],
            ['name' => 'AI Automation Team', 'position' => 'Intelligent Workflows', 'bio' => 'Product thinkers building smart workflows and AI-powered tools that reduce manual work.', 'skills' => ['AI Solutions', 'Automation', 'Integrations'], 'social_links' => []],
        ];
        foreach ($members as $i => $m) {
            TeamMember::create(array_merge($m, ['slug' => Str::slug($m['name']), 'sort_order' => $i]));
        }

        // Categories
        $projectCats = [];
        foreach (['Web Apps', 'Mobile Apps', 'E-Commerce', 'SaaS'] as $c) {
            $projectCats[] = Category::create(['name' => $c, 'slug' => Str::slug($c), 'type' => 'project']);
        }
        $blogCats = [];
        foreach (['Development', 'Design', 'Technology', 'Business'] as $c) {
            $blogCats[] = Category::create(['name' => $c, 'slug' => Str::slug($c), 'type' => 'blog']);
        }

        // Projects
        $projects = [];
        foreach ($projects as $i => $p) {
            Project::create(array_merge($p, ['slug' => Str::slug($p['title']), 'sort_order' => $i, 'completed_at' => now()->subMonths(rand(1, 12))]));
        }

        // Skills
        $skills = [
            ['name' => 'Laravel', 'percentage' => 0, 'color' => '#176BFF'],
            ['name' => 'React', 'percentage' => 0, 'color' => '#00C1FF'],
            ['name' => 'PHP', 'percentage' => 0, 'color' => '#6EA8FF'],
            ['name' => 'UI/UX', 'percentage' => 0, 'color' => '#1673FF'],
            ['name' => 'Mobile Apps', 'percentage' => 0, 'color' => '#00C1FF'],
            ['name' => 'AI Solutions', 'percentage' => 0, 'color' => '#176BFF'],
            ['name' => 'DevOps', 'percentage' => 0, 'color' => '#6EA8FF'],
            ['name' => 'Backend Engineering', 'percentage' => 0, 'color' => '#1673FF'],
        ];
        foreach ($skills as $i => $s) {
            Skill::create(array_merge($s, ['sort_order' => $i]));
        }

        // Testimonials
        $testimonials = [
            ['client_name' => 'Client Name', 'client_position' => 'Founder', 'client_company' => '', 'content' => 'Logicore combines technical quality, speed, and clear communication to deliver solutions that feel reliable from day one.', 'rating' => 5],
        ];
        foreach ($testimonials as $i => $t) {
            Testimonial::create(array_merge($t, ['sort_order' => $i]));
        }

        // Tags
        $tags = [];
        foreach (['Laravel', 'React', 'PHP', 'JavaScript', 'Design', 'Mobile', 'AI', 'DevOps'] as $t) {
            $tags[] = Tag::create(['name' => $t, 'slug' => Str::slug($t)]);
        }

        // Blog Posts
        $posts = [];
        foreach ($posts as $p) {
            $post = Post::create(array_merge($p, ['slug' => Str::slug($p['title']), 'user_id' => $admin->id]));
            $post->tags()->attach(array_rand(array_flip(array_map(fn($t) => $t->id, $tags)), 3));
        }

        // Settings
        $settings = [
            ['key' => 'site_name', 'value' => 'Logicore', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Think. Build. Scale.', 'group' => 'general'],
            ['key' => 'contact_email', 'value' => 'hello@logicore.tech', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '+20 000 000 0000', 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => 'Cairo, Egypt', 'group' => 'contact'],
        ];
        foreach ($settings as $s) {
            Setting::create($s);
        }
    }
}
