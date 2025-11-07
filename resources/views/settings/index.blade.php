<x-admin-layout>
    <x-slot name="title">Settings</x-slot>
    <x-slot name="header">Settings</x-slot>

    <div class="space-y-6">
        <!-- Page Header -->
        <div>
            <h2 class="text-xl lg:text-2xl font-bold text-gray-900">Settings</h2>
            <p class="mt-1 text-sm text-gray-600">Manage your account and system preferences</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6">
                
                <!-- Profile Settings -->
                <a href="{{ route('settings.profile') }}" class="block group">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition">
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-12 h-12 bg-[#f2cc0d] rounded-lg flex items-center justify-center group-hover:scale-110 transition">
                                    <svg class="w-7 h-7 text-[#181711]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-gray-900">Profile</h3>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-sm text-gray-600 mb-4">Update your personal information and email address.</p>
                            <div class="flex items-center text-blue-600 font-medium text-sm">
                                Manage Profile
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Security Settings -->
                <a href="{{ route('settings.security') }}" class="block group">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition">
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-gray-900">Security</h3>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-sm text-gray-600 mb-4">Change your password and manage security settings.</p>
                            <div class="flex items-center text-green-600 font-medium text-sm">
                                Manage Security
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- System Settings (Admin Only) -->
                @can('admin')
                <a href="{{ route('settings.system') }}" class="block group">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition">
                        <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-gray-900">System</h3>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-sm text-gray-600 mb-4">Configure system-wide settings and preferences.</p>
                            <div class="flex items-center text-purple-600 font-medium text-sm">
                                Manage System
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
                @endcan

            </div>

        </div>
    </div>
</x-admin-layout>
