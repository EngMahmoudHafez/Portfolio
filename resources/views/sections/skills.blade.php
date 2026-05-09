<section id="skills" class="py-24 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-primary-400 font-semibold text-sm tracking-wider uppercase">Expertise</span>
            <h2 class="text-4xl md:text-5xl font-bold mt-3 mb-4">Our <span class="text-gradient">Skills</span></h2>
        </div>
        <div class="max-w-3xl mx-auto space-y-6">
            @forelse($skills as $skill)
            <div x-data="{ width: 0 }" x-intersect="setTimeout(() => width = {{ $skill->percentage }}, 200)">
                <div class="flex justify-between mb-2">
                    <span class="text-white font-medium">{{ $skill->name }}</span>
                    <span class="text-primary-400 font-semibold" x-text="width + '%'">0%</span>
                </div>
                <div class="h-3 glass rounded-full overflow-hidden">
                    <div class="h-full rounded-full transition-all duration-1000 ease-out" :style="'width:'+width+'%; background:{{ $skill->color }}'"></div>
                </div>
            </div>
            @empty
            @foreach([['n'=>'Laravel','p'=>95,'c'=>'#ef4444'],['n'=>'React','p'=>88,'c'=>'#3b82f6'],['n'=>'PHP','p'=>92,'c'=>'#8b5cf6'],['n'=>'UI/UX','p'=>85,'c'=>'#f59e0b'],['n'=>'Mobile Apps','p'=>80,'c'=>'#10b981'],['n'=>'AI','p'=>70,'c'=>'#ec4899'],['n'=>'DevOps','p'=>75,'c'=>'#6366f1']] as $s)
            <div x-data="{ width: 0 }" x-intersect="setTimeout(() => width = {{ $s['p'] }}, 200)">
                <div class="flex justify-between mb-2">
                    <span class="text-white font-medium">{{ $s['n'] }}</span>
                    <span class="text-primary-400 font-semibold" x-text="width + '%'">0%</span>
                </div>
                <div class="h-3 glass rounded-full overflow-hidden">
                    <div class="h-full rounded-full transition-all duration-1000 ease-out" :style="'width:'+width+'%; background:{{ $s['c'] }}'"></div>
                </div>
            </div>
            @endforeach
            @endforelse
        </div>
    </div>
</section>
