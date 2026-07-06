<section id="skills" class="py-24 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-primary-400 font-semibold text-sm uppercase tracking-normal">Expertise</span>
            <h2 class="text-4xl md:text-5xl font-bold mt-3 mb-4">Our <span class="text-gradient">Skills</span></h2>
        </div>
        <div class="mx-auto grid max-w-4xl grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
            @forelse($skills as $skill)
            <div class="glass rounded-lg px-5 py-4 text-center text-sm font-semibold text-gray-200 transition-all duration-300 hover:-translate-y-1 hover:text-white">
                {{ $skill->name }}
            </div>
            @empty
            @foreach(['Laravel', 'React', 'PHP', 'UI/UX', 'Mobile Apps', 'AI Solutions', 'DevOps', 'Backend Engineering'] as $skillName)
            <div class="glass rounded-lg px-5 py-4 text-center text-sm font-semibold text-gray-200 transition-all duration-300 hover:-translate-y-1 hover:text-white">
                {{ $skillName }}
            </div>
            @endforeach
            @endforelse
        </div>
    </div>
</section>
