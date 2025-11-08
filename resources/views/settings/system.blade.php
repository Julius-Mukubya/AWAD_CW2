@extends('layouts.admin.app')

@section('title', '')

@section('content')

    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl lg:text-2xl font-bold text-gray-900">System Settings</h2>
                <p class="mt-1 text-sm text-gray-600">Configure system-wide preferences</p>
            </div>
            <a href="{{ route('settings.index') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Settings
            </a>
        </div>
        
        @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('settings.system.update') }}" method="POST">
                @csrf
                @method('PUT')

                <!-- General Settings -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">General Settings</h3>
                                <p class="text-sm text-gray-600">Basic system configuration</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 space-y-6">
                        <div>
                            <label for="app_name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Application Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="app_name" id="app_name" value="{{ old('app_name', $settings['app_name']) }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition">
                        </div>

                        <div>
                            <label for="timezone" class="block text-sm font-semibold text-gray-700 mb-2">
                                Timezone <span class="text-red-500">*</span>
                            </label>
                            <select name="timezone" id="timezone" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition">
                                <option value="UTC" {{ $settings['timezone'] == 'UTC' ? 'selected' : '' }}>UTC</option>
                                <option value="Africa/Kampala" {{ $settings['timezone'] == 'Africa/Kampala' ? 'selected' : '' }}>Africa/Kampala (EAT)</option>
                                <option value="Africa/Nairobi" {{ $settings['timezone'] == 'Africa/Nairobi' ? 'selected' : '' }}>Africa/Nairobi (EAT)</option>
                                <option value="Africa/Lagos" {{ $settings['timezone'] == 'Africa/Lagos' ? 'selected' : '' }}>Africa/Lagos (WAT)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Registration Settings -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-10 h-10 bg-[#f2cc0d] rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#181711]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Registration Settings</h3>
                                <p class="text-sm text-gray-600">Configure rider registration preferences</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 space-y-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <label for="registration_approval" class="block text-sm font-semibold text-gray-700">
                                    Require Admin Approval
                                </label>
                                <p class="text-sm text-gray-500 mt-1">New rider registrations require admin approval before activation</p>
                            </div>
                            <div class="ml-4">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="registration_approval" id="registration_approval" 
                                        {{ $settings['registration_approval'] ? 'checked' : '' }}
                                        class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- System Information -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-10 h-10 bg-gray-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">System Information</h3>
                                <p class="text-sm text-gray-600">Read-only system details</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Laravel Version</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ app()->version() }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">PHP Version</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ PHP_VERSION }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Environment</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ config('app.env') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Debug Mode</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ config('app.debug') ? 'Enabled' : 'Disabled' }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-4">
                    <a href="{{ route('settings.index') }}" 
                        class="px-6 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-8 py-3 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 transition">
                        Save Settings
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
