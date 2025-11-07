<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Kampala Boda Boda Association</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;700;900&display=swap" rel="stylesheet">
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
                            <path d="M24 4C25.7818 14.2173 33.7827 22.2182 44 24C33.7827 25.7818 25.7818 33.7827 24 44C22.2182 33.7827 14.2173 25.7818 4 24C14.2173 22.2182 22.2182 14.2173 24 4Z"></path>
                        </svg>
                        <h1 class="text-2xl font-bold">Kampala Boda Boda Association</h1>
                    </div>
                </div>
                
                <div class="space-y-6">
                    <h2 class="text-4xl font-bold leading-tight">
                        Join Our Growing Community
                    </h2>
                    <p class="text-xl text-gray-200">
                        Register today to access exclusive benefits, resources, and support from Uganda's leading boda boda network.
                    </p>
                    
                    <div class="space-y-4 mt-8">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-5 h-5 text-text-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg">Official Recognition</h3>
                                <p class="text-gray-300">Get legitimacy and protection under the official association</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-5 h-5 text-text-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg">Safety & Insurance</h3>
                                <p class="text-gray-300">Access affordable insurance and safety training programs</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-5 h-5 text-text-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg">Community Support</h3>
                                <p class="text-gray-300">Connect with thousands of riders across Kampala</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Registration Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <!-- Mobile Logo -->
                <div class="lg:hidden flex items-center justify-center gap-3 mb-8">
                    <svg class="w-8 h-8 text-primary" fill="currentColor" viewBox="0 0 48 48">
                        <path d="M24 4C25.7818 14.2173 33.7827 22.2182 44 24C33.7827 25.7818 25.7818 33.7827 24 44C22.2182 33.7827 14.2173 25.7818 4 24C14.2173 22.2182 22.2182 14.2173 24 4Z"></path>
                    </svg>
                    <h1 class="text-xl font-bold text-text-light dark:text-white">Kampala Boda Boda</h1>
                </div>

                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-text-light dark:text-white mb-2">Create your account</h2>
                    <p class="text-gray-500 dark:text-gray-400">Join the official network in just a few steps</p>
                </div>

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

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-text-light dark:text-white mb-2">
                            Full Name
                        </label>
                        <input 
                            id="name" 
                            type="text" 
                            name="name" 
                            value="{{ old('name') }}"
                            required 
                            autofocus
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-primary focus:border-transparent bg-white dark:bg-black/20 text-text-light dark:text-white outline-none transition duration-200"
                            placeholder="John Doe"
                        >
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-text-light dark:text-white mb-2">
                            Email Address
                        </label>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-primary focus:border-transparent bg-white dark:bg-black/20 text-text-light dark:text-white outline-none transition duration-200"
                            placeholder="rider@example.com"
                        >
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-text-light dark:text-white mb-2">
                            Password
                        </label>
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="new-password"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-primary focus:border-transparent bg-white dark:bg-black/20 text-text-light dark:text-white outline-none transition duration-200"
                            placeholder="Create a strong password"
                        >
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Must be at least 8 characters long</p>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-text-light dark:text-white mb-2">
                            Confirm Password
                        </label>
                        <input 
                            id="password_confirmation" 
                            type="password" 
                            name="password_confirmation" 
                            required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-primary focus:border-transparent bg-white dark:bg-black/20 text-text-light dark:text-white outline-none transition duration-200"
                            placeholder="Re-enter your password"
                        >
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="flex items-start">
                        <input 
                            id="terms" 
                            type="checkbox" 
                            required
                            class="w-4 h-4 mt-1 rounded border-gray-300 text-primary focus:ring-primary focus:ring-offset-0 transition duration-200"
                        >
                        <label for="terms" class="ml-2 text-sm text-text-light dark:text-white">
                            I agree to the <a href="#" class="text-primary hover:text-yellow-500 font-medium">Terms of Service</a> and <a href="#" class="text-primary hover:text-yellow-500 font-medium">Privacy Policy</a>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit"
                        class="w-full bg-primary hover:bg-yellow-400 text-text-light dark:text-background-light font-semibold py-3 px-4 rounded-lg transition duration-200 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl"
                    >
                        Create Account
                    </button>
                </form>

                <!-- Login Link -->
                <div class="mt-6 text-center">
                    <p class="text-text-light dark:text-white">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="font-medium text-primary hover:text-yellow-500 transition duration-200">
                            Sign in
                        </a>
                    </p>
                </div>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-background-light dark:bg-background-dark text-gray-500 dark:text-gray-400">Secure registration</span>
                    </div>
                </div>

                <!-- Security Badge -->
                <div class="flex items-center justify-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    <span>Your information is protected and encrypted</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>