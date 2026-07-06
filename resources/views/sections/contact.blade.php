<section id="contact" class="py-24 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-primary-400 font-semibold text-sm uppercase tracking-normal">Get In Touch</span>
            <h2 class="text-4xl md:text-5xl font-bold mt-3 mb-4">Contact <span class="text-gradient">Us</span></h2>
        </div>
        <div class="grid lg:grid-cols-2 gap-12">
            <div>
                <h3 class="text-2xl font-bold text-white mb-6">Let's build something scalable</h3>
                <p class="text-gray-400 mb-8">Have a project, product idea, or system that needs improvement? Send us a message and we'll get back to you.</p>
                <div class="space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 glass rounded-lg flex items-center justify-center text-primary-400"><i class="fas fa-envelope"></i></div>
                        <div><div class="text-gray-400 text-sm">Email</div><div class="text-white font-medium">hello@logicore.tech</div></div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 glass rounded-lg flex items-center justify-center text-primary-400"><i class="fas fa-phone"></i></div>
                        <div><div class="text-gray-400 text-sm">Phone</div><div class="text-white font-medium">+20 000 000 0000</div></div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 glass rounded-lg flex items-center justify-center text-primary-400"><i class="fas fa-map-marker-alt"></i></div>
                        <div><div class="text-gray-400 text-sm">Location</div><div class="text-white font-medium">Cairo, Egypt</div></div>
                    </div>
                </div>
                <div class="flex gap-3 mt-8">
                    <a href="#" class="w-10 h-10 glass rounded-lg flex items-center justify-center text-gray-400 hover:text-primary-400 transition-all"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="w-10 h-10 glass rounded-lg flex items-center justify-center text-gray-400 hover:text-primary-400 transition-all"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="w-10 h-10 glass rounded-lg flex items-center justify-center text-gray-400 hover:text-primary-400 transition-all"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="w-10 h-10 glass rounded-lg flex items-center justify-center text-gray-400 hover:text-primary-400 transition-all"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <form action="{{ route('contact.store') }}" method="POST" class="glass rounded-lg p-8 space-y-5">
                @csrf
                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm text-gray-400 mb-2">Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 bg-white/5 border border-primary-500/20 rounded-lg text-white placeholder-gray-500 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition" placeholder="Your name">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-400 mb-2">Email *</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 bg-white/5 border border-primary-500/20 rounded-lg text-white placeholder-gray-500 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition" placeholder="your@email.com">
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm text-gray-400 mb-2">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-3 bg-white/5 border border-primary-500/20 rounded-lg text-white placeholder-gray-500 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition" placeholder="+20 000 000 0000">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-400 mb-2">Subject *</label>
                        <input type="text" name="subject" value="{{ old('subject') }}" required class="w-full px-4 py-3 bg-white/5 border border-primary-500/20 rounded-lg text-white placeholder-gray-500 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition" placeholder="Project inquiry">
                    </div>
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-2">Message *</label>
                    <textarea name="message" rows="5" required class="w-full px-4 py-3 bg-white/5 border border-primary-500/20 rounded-lg text-white placeholder-gray-500 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition resize-none" placeholder="Tell us about your project...">{{ old('message') }}</textarea>
                </div>
                <button type="submit" class="w-full px-8 py-4 gradient-primary text-white font-semibold rounded-lg hover:opacity-90 transition-all hover:shadow-lg hover:shadow-primary-500/25">
                    Send Message <i class="fas fa-paper-plane ml-2"></i>
                </button>
            </form>
        </div>
    </div>
</section>
