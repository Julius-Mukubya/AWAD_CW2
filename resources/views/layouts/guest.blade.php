<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Kampala Boda Boda Association</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "primary": "#0055A4",
                    "secondary": "#FCD116",
                    "background-light": "#F8F9FA",
                    "background-dark": "#101922",
                    "text-light": "#212529",
                    "text-dark": "#F8F9FA",
                    "card-light": "#FFFFFF",
                    "card-dark": "#182431",
                },
                fontFamily: {
                    "display": ["Inter", "sans-serif"]
                },
                borderRadius: {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
                },
            },
        },
    }
    </script>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-text-light dark:text-text-dark">
    <div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
        <div class="layout-container flex h-full grow flex-col">
            <!-- Main Content Wrapper -->
            <div class="px-4 md:px-6 lg:px-0 flex flex-1 justify-center w-full">
                <div class="layout-content-container flex flex-col w-full flex-1">
                    <!-- Header -->
                    <header
                        class="flex items-center justify-between whitespace-nowrap border-b border-solid border-gray-200 dark:border-gray-700 px-6 sm:px-12 lg:px-20 py-5 w-full bg-white/90 backdrop-blur-md relative">

                        <!-- Logo -->
                        <div class="flex items-center gap-4">
                            <div class="size-6 text-secondary">
                                <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M24 4C25.7818 14.2173 33.7827 22.2182 44 24C33.7827 25.7818 25.7818 33.7827 24 44C22.2182 33.7827 14.2173 25.7818 4 24C14.2173 22.2182 22.2182 14.2173 24 4Z"
                                        fill="currentColor"></path>
                                </svg>
                            </div>
                            <h2
                                class="text-lg font-bold leading-tight tracking-[-0.015em] text-text-light dark:text-text-dark">
                                Kampala Boda Boda Association
                            </h2>
                        </div>

                        <!-- Desktop Nav -->
                        <nav class="hidden md:flex flex-1 justify-end items-center gap-4">
                            <a class="text-sm font-medium text-text-light hover:text-primary px-3" href="/">Home</a>
                            <a class="text-sm font-medium text-text-light hover:text-primary px-3" href="/about">About</a>
                            <a class="text-sm font-medium text-text-light hover:text-primary px-3" href="/riders">Riders</a>
                            @if(Route::has('login'))
                            @auth
                            @if(auth()->user()->isAdmin())
                            <a class="text-sm font-medium text-text-light hover:text-primary px-3"
                                href="{{ url('/dashboard') }}">Dashboard</a>
                            @endif
                            <a class="text-sm font-medium text-text-light hover:text-primary px-3"
                                href="{{ route('self-register') }}">Self-Register</a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#f2cc0d] text-[#181711] rounded-lg hover:bg-yellow-400 font-semibold transition shadow-sm">
                                    Logout
                                </button>
                            </form>
                            @else
                            <a class="text-sm font-medium text-text-light hover:text-primary px-3"
                                href="{{ route('self-register') }}">Self-Register</a>
                            <a class="inline-flex items-center px-4 py-2 bg-[#f2cc0d] text-[#181711] rounded-lg hover:bg-yellow-400 font-semibold transition shadow-sm"
                                href="{{ route('login') }}">Login</a>
                            <a class="inline-flex items-center px-4 py-2 bg-[#f2cc0d] text-[#181711] rounded-lg hover:bg-yellow-400 font-semibold transition shadow-sm"
                                href="{{ route('register') }}">Sign Up</a>
                            @endauth
                            @endif
                        </nav>

                        <!-- Mobile Menu Button -->
                        <div class="md:hidden">
                            <button id="menu-btn" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                                <span class="material-symbols-outlined text-text-light dark:text-text-dark">menu</span>
                            </button>
                        </div>
                    </header>

                    <!-- Mobile Menu (hidden by default) -->
                    <nav id="mobile-menu"
                        class="hidden flex-col bg-white dark:bg-card-dark border-t border-gray-200 dark:border-gray-700 px-6 py-4 space-y-3 md:hidden animate-fade-in">
                        <a class="block text-sm font-medium text-text-light dark:text-text-dark hover:text-primary"
                            href="/">Home</a>
                        <a class="block text-sm font-medium text-text-light dark:text-text-dark hover:text-primary"
                            href="/about">About</a>
                        <a class="block text-sm font-medium text-text-light dark:text-text-dark hover:text-primary"
                            href="/riders">Riders</a>
                        @if(Route::has('login'))
                        @auth
                        @if(auth()->user()->isAdmin())
                        <a class="block text-sm font-medium text-text-light dark:text-text-dark hover:text-primary"
                            href="{{ url('/dashboard') }}">Dashboard</a>
                        @endif
                        <a class="block text-sm font-medium text-text-light dark:text-text-dark hover:text-primary"
                            href="{{ route('self-register') }}">Self-Register</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full px-4 py-2 bg-[#f2cc0d] text-[#181711] rounded-lg hover:bg-yellow-400 font-semibold transition shadow-sm text-center">
                                Logout
                            </button>
                        </form>
                        @else
                        <a class="block text-sm font-medium text-text-light dark:text-text-dark hover:text-primary"
                            href="{{ route('self-register') }}">Self-Register</a>
                        <a class="block px-4 py-2 bg-[#f2cc0d] text-[#181711] rounded-lg hover:bg-yellow-400 font-semibold transition shadow-sm text-center"
                            href="{{ route('login') }}">Login</a>
                        <a class="block px-4 py-2 bg-[#f2cc0d] text-[#181711] rounded-lg hover:bg-yellow-400 font-semibold transition shadow-sm text-center"
                            href="{{ route('register') }}">Sign Up</a>
                        @endauth
                        @endif
                    </nav>

                    <!-- JS Toggle -->
                    <script>
                    const menuBtn = document.getElementById("menu-btn");
                    const mobileMenu = document.getElementById("mobile-menu");

                    menuBtn.addEventListener("click", () => {
                        mobileMenu.classList.toggle("hidden");
                        // optional: change icon between "menu" and "close"
                        const icon = menuBtn.querySelector("span");
                        icon.textContent = mobileMenu.classList.contains("hidden") ? "menu" : "close";
                    });
                    </script>

                   @yield('content')

                    <footer class="bg-white text-gray-800 w-full mt-10 shadow-inner">
                        <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">

                            <!-- Logo & Description -->
                            <div>
                                <h2 class="text-2xl font-bold flex items-center gap-2 text-black">
                                    KBBA
                                </h2>
                                <p class="mt-3 text-sm text-gray-700 leading-relaxed">
                                    Empowering Kampala’s riders through unity, safety, and innovation.
                                    Join the movement towards a better transport future.
                                </p>
                            </div>

                            <!-- Quick Links -->
                            <div>
                                <h3 class="text-lg font-bold mb-4 text-black">Quick Links</h3>
                                <ul class="space-y-2 text-gray-700">
                                    <li><a href="{{ route('home') }}" class="hover:text-yellow-500 transition">Home</a></li>
                                    <li><a href="/about" class="hover:text-yellow-500 transition">About Us</a></li>
                                    <li><a href="{{ route('public.riders') }}" class="hover:text-yellow-500 transition">Riders</a></li>
                                    <li><a href="{{ route('public.stages') }}" class="hover:text-yellow-500 transition">Stages</a></li>
                                </ul>
                            </div>

                            <!-- Support -->
                            <div>
                                <h3 class="text-lg font-bold mb-4 text-black">Support</h3>
                                <ul class="space-y-2 text-gray-700">
                                    <li><a href="{{ route('self-register') }}" class="hover:text-yellow-500 transition">Self-Register</a></li>
                                    <li><a href="{{ route('login') }}" class="hover:text-yellow-500 transition">Login</a></li>
                                    <li><a href="{{ route('register') }}" class="hover:text-yellow-500 transition">Sign Up</a></li>
                                    <li><a href="#" class="hover:text-yellow-500 transition">Privacy Policy</a></li>
                                    <li><a href="#" class="hover:text-yellow-500 transition">Contact Us</a></li>
                                </ul>
                            </div>

                            <!-- Social Media -->
                            <div>
                                <h3 class="text-lg font-bold mb-4 text-black">Follow Us</h3>
                                <div class="space-x-3">
                                    <a href="#"
                                        class="inline-block w-10 h-10 bg-black text-white rounded-full text-center leading-10 hover:bg-yellow-500 transition">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#"
                                        class="inline-block w-10 h-10 bg-black text-white rounded-full text-center leading-10 hover:bg-yellow-500 transition">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#"
                                        class="inline-block w-10 h-10 bg-black text-white rounded-full text-center leading-10 hover:bg-yellow-500 transition">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                    <a href="#"
                                        class="inline-block w-10 h-10 bg-black text-white rounded-full text-center leading-10 hover:bg-yellow-500 transition">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </div>
                            </div>


                            <!-- Bottom Bar -->
                            <div class="border-t border-gray-200 text-center py-4 text-sm text-gray-600">
                                © 2025 Kampala Boda Boda Association. All rights reserved.
                            </div>
                    </footer>

                </div>
            </div>
        </div>
    </div>
</body>

</html>