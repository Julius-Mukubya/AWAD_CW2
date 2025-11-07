<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Kampala Boda Boda Association</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;700;900&display=swap"
        rel="stylesheet">

    <script>
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    'primary': '#f2cc0d',
                    'background-light': '#f8f8f5',
                    'background-dark': '#221f10',
                    'text-light': '#181711'
                },
                fontFamily: {
                    'display': ['Public Sans']
                }
            }
        }
    }
    </script>
</head>

<body class="font-display bg-background-light dark:bg-background-dark text-text-light dark:text-background-light">
    <div class="min-h-screen flex">
        <!-- Left Side - Hero Image -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-cover bg-center bg-no-repeat"
            style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDbh5bzStfzY6OjMS5zvarQZjcVLzyHjYEB43EPtnKSoNa4VSfrTbBAvKnvQTyta9s73K2yYcDnaQo7ovU97coAZx_6WrDD2VpjbUVi6ytsghz1kjg1qzH6S8lBd2DjVvAyJwEb7_8PtMoXWhok4DjB73jZyLFCXdIxcXB0qL_i0fr_zSikD5tVw2_6na6HMFE6YAKs0aXgMd2Gma5tXuRkrDvLIJwq4yaAMgMxjKUaV03hg2IyZiBeTe03EOi4ARC4--ax2Gs-z1A');">
            <!-- Overlay -->
            <div class="absolute inset-0 bg-black/60"></div>

            <!-- Text Content -->
            <div class="relative z-10 flex flex-col justify-between p-12 text-white w-full">
                <div>
                    <div class="flex items-center gap-3 mb-8">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 48 48">
                            <path
                                d="M24 4C25.7818 14.2173 33.7827 22.2182 44 24C33.7827 25.7818 25.7818 33.7827 24 44C22.2182 33.7827 14.2173 25.7818 4 24C14.2173 22.2182 22.2182 14.2173 24 4Z">
                            </path>
                        </svg>
                        <h1 class="text-2xl font-bold">Kampala Boda Boda Association</h1>
                    </div>
                </div>

                <div class="space-y-6">
                    <h2 class="text-4xl font-bold leading-tight">Welcome Back</h2>
                    <p class="text-xl text-gray-200">
                        Access your dashboard to manage your registration, view your profile, and stay connected.
                    </p>

                    <div class="grid grid-cols-3 gap-6 mt-12 pt-8 border-t border-white/20">
                        <div>
                            <div class="text-3xl font-bold">5,000+</div>
                            <div class="text-sm text-gray-300">Registered Riders</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold">150+</div>
                            <div class="text-sm text-gray-300">Active Stages</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold">98%</div>
                            <div class="text-sm text-gray-300">Satisfaction Rate</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Right Side - Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <!-- Mobile Logo -->
                <div class="lg:hidden flex items-center justify-center gap-3 mb-8">
                    <svg class="w-8 h-8 text-primary" fill="currentColor" viewBox="0 0 48 48">
                        <path
                            d="M24 4C25.7818 14.2173 33.7827 22.2182 44 24C33.7827 25.7818 25.7818 33.7827 24 44C22.2182 33.7827 14.2173 25.7818 4 24C14.2173 22.2182 22.2182 14.2173 24 4Z">
                        </path>
                    </svg>
                    <h1 class="text-xl font-bold text-text-light dark:text-white">Kampala Boda Boda</h1>
                </div>

                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-text-light dark:text-white mb-2">Sign in to your account</h2>
                    <p class="text-gray-500 dark:text-gray-400">Enter your credentials to access your dashboard</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                <div
                    class="mb-4 p-4 rounded-lg bg-green-50 dark:bg-green-900 border border-green-200 dark:border-green-700">
                    <p class="text-sm text-green-800 dark:text-green-200">{{ session('status') }}</p>
                </div>
                @endif

                <!-- Validation Errors -->
                @if ($errors->any())
                <div class="mb-4 p-4 rounded-lg bg-red-50 dark:bg-red-900 border border-red-200 dark:border-red-700">
                    <div class="text-sm text-red-800 dark:text-red-200 space-y-1">
                        @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-text-light dark:text-white mb-2">Email
                            Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-primary focus:border-transparent bg-white dark:bg-black/20 text-text-light dark:text-white outline-none transition duration-200"
                            placeholder="rider@example.com">
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password"
                            class="block text-sm font-medium text-text-light dark:text-white mb-2">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-primary focus:border-transparent bg-white dark:bg-black/20 text-text-light dark:text-white outline-none transition duration-200"
                            placeholder="Enter your password">
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input id="remember_me" type="checkbox" name="remember"
                                class="w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary focus:ring-offset-0 transition duration-200">
                            <span class="ml-2 text-sm text-text-light dark:text-white">Remember me</span>
                        </label>

                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-sm font-medium text-primary hover:text-yellow-500 transition duration-200">Forgot
                            password?</a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-primary hover:bg-yellow-400 text-text-light dark:text-background-light font-semibold py-3 px-4 rounded-lg transition duration-200 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl">
                        Sign in
                    </button>
                </form>

                <!-- Register Link -->
                @if (Route::has('register'))
                <div class="mt-6 text-center">
                    <p class="text-text-light dark:text-white">
                        Don't have an account?
                        <a href="{{ route('register') }}"
                            class="font-medium text-primary hover:text-yellow-500 transition duration-200">Register
                            now</a>
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>
</body>

</html>