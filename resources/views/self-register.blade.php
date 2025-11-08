@extends('layouts.guest')

@section('content')
<main class="w-full">
    <!-- Hero Section -->
    <section class="w-full">
        <div class="@container">
            <div class="flex min-h-[350px] flex-col gap-6 bg-cover bg-center bg-no-repeat @[480px]:gap-8 items-center justify-center p-4 text-center"
                data-alt="Boda boda rider registration"
                style='background-image: linear-gradient(rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.6) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuAmrUfO4yBAvAl9qVaZnnuB4zKDM62F4iI_RndonH9VTjlTd6fQMkDwwFYmqMKCWXRArC_R6zd9n86DhyD4m1k5Ifucyyn1uOnxO1BGFPKBhK6IJqBcDAbx5wO2wsz_nPKf9KApfeTBrxknou3mVfj5FZ10MhpbN7roIEfvPQU1pA8l6wQe3m5wFnWWuzjPah1tGV-gM6DgqGiGMU6X5YhangmXho5WUrD1l9YrthEC5Ca881z1alLgH0VpfAhfumavn8cF2q9tcRg");'>
                <div class="flex flex-col gap-4 max-w-3xl items-center text-center">
                    <h1 class="text-white text-4xl font-black leading-tight tracking-[-0.033em] @[480px]:text-5xl">
                        Rider Self-Registration
                    </h1>
                    <h2 class="text-white/90 text-sm font-normal leading-normal @[480px]:text-base">
                        Register as a boda boda rider. Your application will be reviewed by our team.
                    </h2>
                </div>
            </div>
        </div>
    </section>

    <div class="container mx-auto px-4 py-10 max-w-4xl">

        <!-- Registration Form -->
        <div class="bg-white dark:bg-black/20 rounded-xl shadow-lg p-6 lg:p-8">
            @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
            @endif

            @if(session('info'))
            <div class="mb-6 bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                {{ session('info') }}
            </div>
            @endif

            @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(isset($existingRider))
            <!-- Existing Registration Status -->
            <div class="mb-6 p-6 {{ $existingRider->status === 'pending' ? 'bg-blue-50 dark:bg-blue-900/20 border-2 border-blue-300 dark:border-blue-700' : 'bg-yellow-50 dark:bg-yellow-900/20 border-2 border-yellow-300 dark:border-yellow-700' }} rounded-lg">
                <div class="flex items-start gap-4">
                    <span class="material-symbols-outlined {{ $existingRider->status === 'pending' ? 'text-blue-600 dark:text-blue-400' : 'text-yellow-600 dark:text-yellow-400' }} text-3xl">
                        {{ $existingRider->status === 'pending' ? 'edit_note' : 'info' }}
                    </span>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold {{ $existingRider->status === 'pending' ? 'text-blue-900 dark:text-blue-100' : 'text-yellow-900 dark:text-yellow-100' }} mb-2">
                            {{ $existingRider->status === 'pending' ? 'Application Pending - You Can Edit' : 'Application Already Submitted' }}
                        </h3>
                        <p class="{{ $existingRider->status === 'pending' ? 'text-blue-800 dark:text-blue-200' : 'text-yellow-800 dark:text-yellow-200' }} mb-3">
                            @if($existingRider->status === 'pending')
                                Your application is pending review. You can update your information below until it's approved.
                            @else
                                You have already submitted a registration application. Your current status is: 
                                <span class="font-bold">{{ ucfirst($existingRider->status) }}</span>
                            @endif
                        </p>
                        <p class="text-sm {{ $existingRider->status === 'pending' ? 'text-blue-700 dark:text-blue-300' : 'text-yellow-700 dark:text-yellow-300' }}">
                            Registration Number: <span class="font-semibold">{{ $existingRider->registration_number }}</span>
                        </p>
                        @if($existingRider->status !== 'pending')
                        <div class="mt-4 flex gap-3">
                            <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg transition">
                                <span class="material-symbols-outlined text-sm mr-2">home</span>
                                Go to Home
                            </a>
                            @if(auth()->check())
                            <button onclick="clearRegistrationCheck()" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition">
                                <span class="material-symbols-outlined text-sm mr-2">refresh</span>
                                Check Another Registration
                            </button>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <form action="{{ isset($existingRider) && $existingRider->status === 'pending' ? route('self-register.update', $existingRider->id) : route('self-register.store') }}" method="POST" class="space-y-6" @if(isset($existingRider) && $existingRider->status !== 'pending') style="pointer-events: none; opacity: 0.7;" @endif>
                @csrf
                @if(isset($existingRider) && $existingRider->status === 'pending')
                    @method('PUT')
                @endif

                <!-- Personal Information Section -->
                <div>
                    <h3 class="text-lg font-semibold text-[#181711] dark:text-white mb-4 pb-2 border-b border-gray-200">
                        Personal Information
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">First Name *</label>
                            <input type="text" name="first_name" value="{{ $existingRider->first_name ?? old('first_name') }}" {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'readonly' : 'required' }}
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-black/20 text-[#181711] dark:text-white focus:ring-2 focus:ring-[#f2cc0d] focus:border-transparent {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Last Name *</label>
                            <input type="text" name="last_name" value="{{ $existingRider->last_name ?? old('last_name') }}" {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'readonly' : 'required' }}
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-black/20 text-[#181711] dark:text-white focus:ring-2 focus:ring-[#f2cc0d] focus:border-transparent {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">National ID *</label>
                            <input type="text" name="national_id" value="{{ $existingRider->national_id ?? old('national_id') }}" {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'readonly' : 'required' }}
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-black/20 text-[#181711] dark:text-white focus:ring-2 focus:ring-[#f2cc0d] focus:border-transparent {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Date of Birth *</label>
                            <input type="date" name="date_of_birth" value="{{ isset($existingRider) && $existingRider->date_of_birth ? $existingRider->date_of_birth->format('Y-m-d') : old('date_of_birth') }}" {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'readonly' : 'required' }}
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-black/20 text-[#181711] dark:text-white focus:ring-2 focus:ring-[#f2cc0d] focus:border-transparent {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Phone Number *</label>
                            <input type="tel" name="phone_number" value="{{ $existingRider->phone_number ?? old('phone_number') }}" {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'readonly' : 'required' }}
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-black/20 text-[#181711] dark:text-white focus:ring-2 focus:ring-[#f2cc0d] focus:border-transparent {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email (Optional)</label>
                            <input type="email" name="email" value="{{ $existingRider->email ?? old('email') }}" {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'readonly' : '' }}
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-black/20 text-[#181711] dark:text-white focus:ring-2 focus:ring-[#f2cc0d] focus:border-transparent {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Physical Address *</label>
                            <textarea name="address" rows="2" {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'readonly' : 'required' }}
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-black/20 text-[#181711] dark:text-white focus:ring-2 focus:ring-[#f2cc0d] focus:border-transparent {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'bg-gray-100 dark:bg-gray-800' : '' }}">{{ $existingRider->address ?? old('address') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Boda Stage *</label>
                            <select name="stage_id" {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'disabled' : 'required' }}
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-black/20 text-[#181711] dark:text-white focus:ring-2 focus:ring-[#f2cc0d] focus:border-transparent {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                                <option value="">Select Stage</option>
                                @foreach($stages as $stage)
                                    <option value="{{ $stage->id }}" {{ (isset($existingRider) && $existingRider->stage_id == $stage->id) || old('stage_id') == $stage->id ? 'selected' : '' }}>
                                        {{ $stage->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- License Information Section -->
                <div>
                    <h3 class="text-lg font-semibold text-[#181711] dark:text-white mb-4 pb-2 border-b border-gray-200">
                        License Information
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">License Number *</label>
                            <input type="text" name="license_number" value="{{ $existingRider->license_number ?? old('license_number') }}" {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'readonly' : 'required' }}
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-black/20 text-[#181711] dark:text-white focus:ring-2 focus:ring-[#f2cc0d] focus:border-transparent {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">License Class *</label>
                            <select name="license_class" {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'disabled' : 'required' }}
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-black/20 text-[#181711] dark:text-white focus:ring-2 focus:ring-[#f2cc0d] focus:border-transparent {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                                <option value="">Select Class</option>
                                <option value="A" {{ (isset($existingRider) && $existingRider->license_class == 'A') || old('license_class') == 'A' ? 'selected' : '' }}>Class A</option>
                                <option value="A1" {{ (isset($existingRider) && $existingRider->license_class == 'A1') || old('license_class') == 'A1' ? 'selected' : '' }}>Class A1</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">License Issue Date *</label>
                            <input type="date" name="license_issue_date" value="{{ isset($existingRider) && $existingRider->license_issue_date ? $existingRider->license_issue_date->format('Y-m-d') : old('license_issue_date') }}" {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'readonly' : 'required' }}
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-black/20 text-[#181711] dark:text-white focus:ring-2 focus:ring-[#f2cc0d] focus:border-transparent {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">License Expiry Date</label>
                            <input type="date" name="license_expiry_date" value="{{ isset($existingRider) && $existingRider->license_expiry_date ? $existingRider->license_expiry_date->format('Y-m-d') : old('license_expiry_date') }}" {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'readonly' : '' }}
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-black/20 text-[#181711] dark:text-white focus:ring-2 focus:ring-[#f2cc0d] focus:border-transparent {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                        </div>
                    </div>
                </div>

                <!-- Motorcycle Information Section -->
                <div>
                    <h3 class="text-lg font-semibold text-[#181711] dark:text-white mb-4 pb-2 border-b border-gray-200">
                        Motorcycle Information
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Plate Number *</label>
                            <input type="text" name="motorcycle_registration_number" value="{{ $existingRider->motorcycle->registration_number ?? old('motorcycle_registration_number') }}" {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'readonly' : 'required' }}
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-black/20 text-[#181711] dark:text-white focus:ring-2 focus:ring-[#f2cc0d] focus:border-transparent {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Make/Brand *</label>
                            <input type="text" name="motorcycle_make" value="{{ $existingRider->motorcycle->make ?? old('motorcycle_make') }}" {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'readonly' : 'required' }}
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-black/20 text-[#181711] dark:text-white focus:ring-2 focus:ring-[#f2cc0d] focus:border-transparent {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Model *</label>
                            <input type="text" name="motorcycle_model" value="{{ $existingRider->motorcycle->model ?? old('motorcycle_model') }}" {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'readonly' : 'required' }}
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-black/20 text-[#181711] dark:text-white focus:ring-2 focus:ring-[#f2cc0d] focus:border-transparent {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Year *</label>
                            <input type="number" name="motorcycle_year" value="{{ $existingRider->motorcycle->year ?? old('motorcycle_year') }}" {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'readonly' : 'required' }} min="1990" max="{{ date('Y') }}"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-black/20 text-[#181711] dark:text-white focus:ring-2 focus:ring-[#f2cc0d] focus:border-transparent {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Color *</label>
                            <input type="text" name="motorcycle_color" value="{{ $existingRider->motorcycle->color ?? old('motorcycle_color') }}" {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'readonly' : 'required' }}
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-black/20 text-[#181711] dark:text-white focus:ring-2 focus:ring-[#f2cc0d] focus:border-transparent {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Engine Number *</label>
                            <input type="text" name="motorcycle_engine_number" value="{{ $existingRider->motorcycle->engine_number ?? old('motorcycle_engine_number') }}" {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'readonly' : 'required' }}
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-black/20 text-[#181711] dark:text-white focus:ring-2 focus:ring-[#f2cc0d] focus:border-transparent {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Chassis Number *</label>
                            <input type="text" name="motorcycle_chassis_number" value="{{ $existingRider->motorcycle->chassis_number ?? old('motorcycle_chassis_number') }}" {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'readonly' : 'required' }}
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-black/20 text-[#181711] dark:text-white focus:ring-2 focus:ring-[#f2cc0d] focus:border-transparent {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                        </div>
                    </div>
                </div>

                <!-- Emergency Contact Section -->
                <div>
                    <h3 class="text-lg font-semibold text-[#181711] dark:text-white mb-4 pb-2 border-b border-gray-200">
                        Emergency Contact
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Contact Name *</label>
                            <input type="text" name="emergency_contact_name" value="{{ $existingRider->emergency_contact_name ?? old('emergency_contact_name') }}" {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'readonly' : 'required' }}
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-black/20 text-[#181711] dark:text-white focus:ring-2 focus:ring-[#f2cc0d] focus:border-transparent {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Contact Phone *</label>
                            <input type="tel" name="emergency_contact_phone" value="{{ $existingRider->emergency_contact_phone ?? old('emergency_contact_phone') }}" {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'readonly' : 'required' }}
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-black/20 text-[#181711] dark:text-white focus:ring-2 focus:ring-[#f2cc0d] focus:border-transparent {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Relationship *</label>
                            <input type="text" name="emergency_contact_relationship" value="{{ $existingRider->emergency_contact_relationship ?? old('emergency_contact_relationship') }}" {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'readonly' : 'required' }}
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-black/20 text-[#181711] dark:text-white focus:ring-2 focus:ring-[#f2cc0d] focus:border-transparent {{ (isset($existingRider) && $existingRider->status !== 'pending') ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                @if(!isset($existingRider) || $existingRider->status === 'pending')
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <button type="submit"
                        class="flex-1 bg-[#f2cc0d] hover:bg-yellow-400 text-[#181711] font-semibold py-3 px-6 rounded-lg transition duration-200 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl">
                        {{ isset($existingRider) && $existingRider->status === 'pending' ? 'Update Registration' : 'Submit Registration' }}
                    </button>
                    <a href="{{ route('home') }}"
                        class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-3 px-6 rounded-lg transition duration-200 text-center">
                        Cancel
                    </a>
                </div>
                @endif

                @if(!isset($existingRider))
                <p class="text-sm text-gray-500 dark:text-gray-400 text-center mt-4">
                    * Required fields. Your application will be reviewed by our team and you will be notified once approved.
                </p>
                @endif
            </form>
        </div>
    </div>
</main>

<script>
function clearRegistrationCheck() {
    // Clear the session check by making a request
    fetch('{{ route("self-register.clear") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    }).then(() => {
        window.location.href = '{{ route("self-register") }}';
    });
}
</script>
@endsection
