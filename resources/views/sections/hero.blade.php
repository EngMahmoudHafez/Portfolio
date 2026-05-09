<section id="hero" class="relative min-h-screen flex items-center gradient-hero overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute top-20 left-10 w-72 h-72 bg-primary-500/20 rounded-full blur-3xl animate-pulse-slow"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-purple-500/15 rounded-full blur-3xl animate-pulse-slow" style="animation-delay:2s"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-primary-600/10 rounded-full blur-3xl animate-spin-slow"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
        <div class="text-center">
            <div class="inline-flex items-center gap-2 glass rounded-full px-5 py-2 mb-8 animate-fade-in">
                <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                <span class="text-sm text-gray-300">Available for new projects</span>
            </div>
            <h1 class="text-5xl md:text-7xl lg:text-8xl font-black mb-6 leading-tight animate-slide-up">
                We Build<br>
                <span class="text-gradient">Digital</span> Excellence
            </h1>
            <p class="text-lg md:text-xl text-gray-400 max-w-2xl mx-auto mb-10 animate-slide-up" style="animation-delay:.2s">
                A creative agency crafting premium digital experiences through innovative design and cutting-edge technology.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center animate-slide-up" style="animation-delay:.4s">
                <a href="#portfolio" class="px-8 py-4 gradient-primary text-white font-semibold rounded-2xl hover:opacity-90 transition-all hover:shadow-lg hover:shadow-primary-500/25 hover:-translate-y-0.5">
                    View Our Work <i class="fas fa-arrow-right ml-2"></i>
                </a>
                <a href="#contact" class="px-8 py-4 glass text-white font-semibold rounded-2xl hover:bg-white/15 transition-all hover:-translate-y-0.5">
                    <i class="fas fa-play mr-2"></i> Get in Touch
                </a>
            </div>
            <div class="mt-16 flex items-center justify-center gap-8 md:gap-16 animate-fade-in" style="animation-delay:.6s">
                <div class="text-center" x-data="{count:0}" x-intersect="let i=setInterval(()=>{count++;if(count>=150)clearInterval(i)},10)">
                    <div class="text-3xl md:text-4xl font-bold text-white"><span x-text="count">0</span>+</div>
                    <div class="text-sm text-gray-400 mt-1">Projects Done</div>
                </div>
                <div class="w-px h-12 bg-white/10"></div>
                <div class="text-center" x-data="{count:0}" x-intersect="let i=setInterval(()=>{count++;if(count>=50)clearInterval(i)},30)">
                    <div class="text-3xl md:text-4xl font-bold text-white"><span x-text="count">0</span>+</div>
                    <div class="text-sm text-gray-400 mt-1">Happy Clients</div>
                </div>
                <div class="w-px h-12 bg-white/10"></div>
                <div class="text-center" x-data="{count:0}" x-intersect="let i=setInterval(()=>{count++;if(count>=5)clearInterval(i)},200)">
                    <div class="text-3xl md:text-4xl font-bold text-white"><span x-text="count">0</span>+</div>
                    <div class="text-sm text-gray-400 mt-1">Years Exp.</div>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
        <a href="#about" class="text-gray-400 hover:text-white transition"><i class="fas fa-chevron-down text-xl"></i></a>
    </div>
</section>
