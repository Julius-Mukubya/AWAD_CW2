<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard' }} - Bodaboda System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#f2cc0d',
                        'primary-dark': '#d4b30b',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Mobile Menu Overlay -->
        <div id="mobile-menu-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"></div>
        
        <!-- Sidebar -->
        <div id="sidebar" class="fixed lg:static inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 flex-shrink-0 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg class="w-8 h-8 text-[#f2cc0d]" fill="currentColor" viewBox="0 0 48 48">
                        <path d="M24 4C25.7818 14.2173 33.7827 22.2182 44 24C33.7827 25.7818 25.7818 33.7827 24 44C22.2182 33.7827 14.2173 25.7818 4 24C14.2173 22.2182 22.2182 14.2173 24 4Z"></path>
                    </svg>
                    <h1 class="text-xl font-bold text-gray-900">BodaBoda System</h1>
                </div>
                <!-- Close button for mobile -->
                <button id="close-sidebar" class="lg:hidden text-gray-600 hover:text-gray-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <!-- Navigation -->
            <nav class="p-4">
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center px-4 py-3 {{ request()->routeIs('dashboard') ? 'bg-[#f2cc0d] text-[#181711] font-medium' : 'text-gray-700 hover:bg-[#f2cc0d]/10' }} rounded-lg mb-2 transition duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                
                <a href="{{ route('riders.index') }}" 
                   class="flex items-center px-4 py-3 {{ request()->routeIs('riders.*') ? 'bg-[#f2cc0d] text-[#181711] font-medium' : 'text-gray-700 hover:bg-[#f2cc0d]/10' }} rounded-lg mb-2 transition duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Riders
                </a>
                
                <a href="{{ route('stages.index') }}" 
                   class="flex items-center px-4 py-3 {{ request()->routeIs('stages.*') ? 'bg-[#f2cc0d] text-[#181711] font-medium' : 'text-gray-700 hover:bg-[#f2cc0d]/10' }} rounded-lg mb-2 transition duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Stages
                </a>
                
                @can('manage-users')
                <a href="{{ route('users.index') }}" 
                   class="flex items-center px-4 py-3 {{ request()->routeIs('users.*') ? 'bg-[#f2cc0d] text-[#181711] font-medium' : 'text-gray-700 hover:bg-[#f2cc0d]/10' }} rounded-lg mb-2 transition duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    Users
                </a>
                @endcan
                
                <a href="{{ route('reports.index') }}" 
                   class="flex items-center px-4 py-3 {{ request()->routeIs('reports.*') ? 'bg-[#f2cc0d] text-[#181711] font-medium' : 'text-gray-700 hover:bg-[#f2cc0d]/10' }} rounded-lg mb-2 transition duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Reports
                </a>
                
                <a href="{{ route('settings.index') }}" 
                   class="flex items-center px-4 py-3 {{ request()->routeIs('settings.*') ? 'bg-[#f2cc0d] text-[#181711] font-medium' : 'text-gray-700 hover:bg-[#f2cc0d]/10' }} rounded-lg mb-2 transition duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Settings
                </a>
            </nav>
            
            <!-- User Profile at Bottom -->
            <div class="absolute bottom-0 w-64 p-4 border-t border-gray-200 bg-white">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-[#f2cc0d] flex items-center justify-center">
                        <span class="text-sm font-semibold text-[#181711]">{{ Auth::user()->initials ?? 'AU' }}</span>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name ?? 'Admin User' }}</p>
                        <p class="text-xs text-gray-500">{{ ucfirst(Auth::user()->role ?? 'Administrator') }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto flex flex-col">
            <!-- Top Navigation Bar -->
            <div class="bg-white shadow-sm sticky top-0 z-30">
                <div class="px-4 lg:px-8 py-4 flex items-center justify-between">
                    <!-- Mobile menu button -->
                    <button id="mobile-menu-button" class="lg:hidden p-2 text-gray-600 hover:text-gray-900 -ml-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    
                    <h2 class="text-xl lg:text-2xl font-bold text-gray-900">{{ $header ?? 'Dashboard' }}</h2>
                    <div class="flex items-center space-x-2 lg:space-x-4">
                        <button class="p-2 text-gray-600 hover:text-gray-900">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                        </button>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-gray-900">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Page Content -->
            <div class="p-4 lg:p-8 flex-1">
                {{ $slot }}
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const closeSidebar = document.getElementById('close-sidebar');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('mobile-menu-overlay');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeSidebarMenu() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        mobileMenuButton.addEventListener('click', openSidebar);
        closeSidebar.addEventListener('click', closeSidebarMenu);
        overlay.addEventListener('click', closeSidebarMenu);

        // Close sidebar when clicking a link on mobile
        const sidebarLinks = sidebar.querySelectorAll('a');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) {
                    closeSidebarMenu();
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>