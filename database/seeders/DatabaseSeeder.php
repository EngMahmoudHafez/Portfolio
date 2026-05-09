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
            ['title' => 'Web Development', 'icon' => 'fas fa-code', 'icon_color' => '#6366f1', 'description' => 'Custom web applications built with modern frameworks like Laravel, React, and Vue.js for scalable solutions.'],
            ['title' => 'Mobile Apps', 'icon' => 'fas fa-mobile-alt', 'icon_color' => '#ec4899', 'description' => 'Native and cross-platform mobile applications for iOS and Android using Flutter and React Native.'],
            ['title' => 'UI/UX Design', 'icon' => 'fas fa-palette', 'icon_color' => '#f59e0b', 'description' => 'Beautiful, intuitive interfaces designed with user experience at the forefront using Figma and Adobe XD.'],
            ['title' => 'Branding', 'icon' => 'fas fa-paint-brush', 'icon_color' => '#10b981', 'description' => 'Complete brand identity packages including logos, color palettes, and brand guidelines.'],
            ['title' => 'Digital Marketing', 'icon' => 'fas fa-chart-line', 'icon_color' => '#ef4444', 'description' => 'Data-driven marketing strategies including SEO, SEM, and social media campaigns.'],
            ['title' => 'AI Solutions', 'icon' => 'fas fa-robot', 'icon_color' => '#8b5cf6', 'description' => 'Intelligent automation, machine learning models, and AI-powered tools for business optimization.'],
        ];
        foreach ($services as $i => $s) {
            Service::create(array_merge($s, ['slug' => Str::slug($s['title']), 'sort_order' => $i]));
        }

        // Team
        $members = [
            ['name' => 'Ahmed Hassan', 'position' => 'Full Stack Developer', 'bio' => 'Senior developer with 8+ years of experience in Laravel and React.', 'skills' => ['Laravel', 'React', 'TypeScript', 'Docker'], 'social_links' => [['platform' => 'github', 'url' => '#'], ['platform' => 'linkedin-in', 'url' => '#']]],
            ['name' => 'Sara Ali', 'position' => 'UI/UX Designer', 'bio' => 'Creative designer passionate about crafting beautiful user experiences.', 'skills' => ['Figma', 'Adobe XD', 'Tailwind CSS'], 'social_links' => [['platform' => 'dribbble', 'url' => '#'], ['platform' => 'linkedin-in', 'url' => '#']]],
            ['name' => 'Omar Khaled', 'position' => 'Mobile Developer', 'bio' => 'Expert in Flutter and React Native with 5+ years of mobile development.', 'skills' => ['Flutter', 'React Native', 'Swift'], 'social_links' => [['platform' => 'github', 'url' => '#']]],
            ['name' => 'Nour Mohamed', 'position' => 'Project Manager', 'bio' => 'Experienced PM ensuring projects are delivered on time and budget.', 'skills' => ['Agile', 'Scrum', 'Jira'], 'social_links' => [['platform' => 'linkedin-in', 'url' => '#']]],
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
        $projects = [
            ['title' => 'E-Commerce Platform', 'description' => 'A full-featured e-commerce platform with real-time inventory management, payment processing, and analytics dashboard.', 'short_description' => 'Modern e-commerce solution with advanced features.', 'technologies' => ['Laravel', 'Vue.js', 'Stripe', 'Redis'], 'category_id' => $projectCats[2]->id, 'is_featured' => true],
            ['title' => 'Healthcare App', 'description' => 'Mobile application for patients to book appointments, track health metrics, and communicate with doctors.', 'short_description' => 'Patient management and telemedicine app.', 'technologies' => ['Flutter', 'Firebase', 'Node.js'], 'category_id' => $projectCats[1]->id, 'is_featured' => true],
            ['title' => 'SaaS Analytics Dashboard', 'description' => 'Real-time analytics dashboard for SaaS companies to track KPIs, user behavior, and revenue metrics.', 'short_description' => 'Business intelligence dashboard.', 'technologies' => ['React', 'D3.js', 'Laravel', 'PostgreSQL'], 'category_id' => $projectCats[3]->id, 'is_featured' => true],
            ['title' => 'Social Media Manager', 'description' => 'All-in-one social media management tool with scheduling, analytics, and team collaboration features.', 'short_description' => 'Social media management platform.', 'technologies' => ['Next.js', 'GraphQL', 'MongoDB'], 'category_id' => $projectCats[0]->id, 'is_featured' => true],
            ['title' => 'Real Estate Portal', 'description' => 'Property listing and management portal with virtual tours, mortgage calculator, and agent matching.', 'short_description' => 'Smart property marketplace.', 'technologies' => ['Laravel', 'Alpine.js', 'MySQL', 'AWS'], 'category_id' => $projectCats[0]->id],
            ['title' => 'Fitness Tracker', 'description' => 'Cross-platform fitness application with workout plans, nutrition tracking, and progress analytics.', 'short_description' => 'Personal fitness companion app.', 'technologies' => ['React Native', 'Firebase', 'TensorFlow'], 'category_id' => $projectCats[1]->id],
        ];
        foreach ($projects as $i => $p) {
            Project::create(array_merge($p, ['slug' => Str::slug($p['title']), 'sort_order' => $i, 'completed_at' => now()->subMonths(rand(1, 12))]));
        }

        // Skills
        $skills = [
            ['name' => 'Laravel', 'percentage' => 95, 'color' => '#ef4444'],
            ['name' => 'React / Vue.js', 'percentage' => 88, 'color' => '#3b82f6'],
            ['name' => 'PHP', 'percentage' => 92, 'color' => '#8b5cf6'],
            ['name' => 'UI/UX Design', 'percentage' => 85, 'color' => '#f59e0b'],
            ['name' => 'Mobile Development', 'percentage' => 80, 'color' => '#10b981'],
            ['name' => 'AI & Machine Learning', 'percentage' => 70, 'color' => '#ec4899'],
            ['name' => 'DevOps & Cloud', 'percentage' => 75, 'color' => '#6366f1'],
        ];
        foreach ($skills as $i => $s) {
            Skill::create(array_merge($s, ['sort_order' => $i]));
        }

        // Testimonials
        $testimonials = [
            ['client_name' => 'John Smith', 'client_position' => 'CEO', 'client_company' => 'TechCorp', 'content' => 'Outstanding work! They delivered beyond our expectations with incredible attention to detail. Our platform performance increased by 300%.', 'rating' => 5],
            ['client_name' => 'Emily Davis', 'client_position' => 'CTO', 'client_company' => 'StartupXYZ', 'content' => 'Professional team that truly understands modern web development. They transformed our outdated system into a modern, scalable platform.', 'rating' => 5],
            ['client_name' => 'Michael Brown', 'client_position' => 'Founder', 'client_company' => 'InnovateCo', 'content' => 'The best agency we have ever worked with. Quality, speed, and communication were top-notch throughout the entire project.', 'rating' => 5],
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
        $posts = [
            ['title' => 'Building Scalable Apps with Laravel 12', 'excerpt' => 'Explore the latest features in Laravel 12 and how they help build enterprise-grade applications.', 'body' => '<p>Laravel 12 brings exciting new features that make building scalable applications easier than ever. In this article, we explore the key improvements and best practices.</p><h2>New Features</h2><p>The latest version introduces improved performance, better developer experience, and enhanced security features. From improved Eloquent query building to streamlined deployment workflows, Laravel 12 is a game-changer.</p><p>Key highlights include the new query builder improvements, enhanced validation rules, and the revamped authentication system that makes securing your applications simpler.</p>', 'category_id' => $blogCats[0]->id, 'status' => 'published', 'published_at' => now()->subDays(5)],
            ['title' => 'The Future of UI/UX Design in 2025', 'excerpt' => 'Discover the design trends shaping the future of digital experiences.', 'body' => '<p>The world of UI/UX design is constantly evolving. As we move through 2025, several key trends are reshaping how we think about digital experiences.</p><h2>Glassmorphism & Beyond</h2><p>The glassmorphism trend continues to dominate, with its translucent, frosted-glass aesthetic creating depth and hierarchy in interfaces. Combined with micro-animations and dark mode designs, modern interfaces feel more immersive than ever.</p><p>AI-powered design tools are also changing the landscape, enabling designers to iterate faster and create more personalized experiences.</p>', 'category_id' => $blogCats[1]->id, 'status' => 'published', 'published_at' => now()->subDays(10)],
            ['title' => 'Getting Started with AI in Web Development', 'excerpt' => 'How AI is transforming the way we build and deploy web applications.', 'body' => '<p>Artificial Intelligence is no longer a futuristic concept—it is actively transforming web development today. From AI-powered code completion to automated testing, developers have more tools than ever.</p><h2>Practical Applications</h2><p>Learn how to integrate ChatGPT, image recognition, and natural language processing into your web applications. We cover practical examples using Laravel and Python.</p>', 'category_id' => $blogCats[2]->id, 'status' => 'published', 'published_at' => now()->subDays(15)],
        ];
        foreach ($posts as $p) {
            $post = Post::create(array_merge($p, ['slug' => Str::slug($p['title']), 'user_id' => $admin->id]));
            $post->tags()->attach(array_rand(array_flip(array_map(fn($t) => $t->id, $tags)), 3));
        }

        // Settings
        $settings = [
            ['key' => 'site_name', 'value' => 'Portfolio Agency', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Creative Digital Solutions Agency', 'group' => 'general'],
            ['key' => 'contact_email', 'value' => 'hello@portfolio.agency', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '+1 234 567 890', 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => 'Cairo, Egypt', 'group' => 'contact'],
        ];
        foreach ($settings as $s) {
            Setting::create($s);
        }
    }
}
