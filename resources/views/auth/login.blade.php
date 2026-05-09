<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="gradient-hero min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <div class="w-16 h-16 gradient-primary rounded-2xl flex items-center justify-center mx-auto mb-4"><i class="fas fa-code text-white text-2xl"></i></div>
            <h1 class="text-3xl font-bold text-white">Welcome Back</h1>
            <p class="text-gray-400 mt-2">Sign in to your admin dashboard</p>
        </div>
        <form method="POST" action="{{ route('login') }}" class="glass rounded-2xl p-8 space-y-6">
            @csrf
            <div>
                <label class="block text-sm text-gray-400 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition" placeholder="admin@example.com">
                @error('email')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm text-gray-400 mb-2">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition" placeholder="••••••••">
                @error('password')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" name="remember" class="w-4 h-4 rounded bg-white/5 border-white/10 text-primary-500"><span class="text-sm text-gray-400">Remember me</span></label>
            </div>
            <button type="submit" class="w-full px-6 py-3.5 gradient-primary text-white font-semibold rounded-xl hover:opacity-90 transition-all hover:shadow-lg hover:shadow-primary-500/25">
                Sign In <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </form>
        <p class="text-center text-gray-500 text-sm mt-6"><a href="{{ route('home') }}" class="text-primary-400 hover:text-primary-300 transition">&larr; Back to website</a></p>
    </div>
</body>
</html>
