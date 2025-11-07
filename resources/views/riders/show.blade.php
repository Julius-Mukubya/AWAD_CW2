<x-admin-layout>
    <x-slot name="title">{{ $rider->first_name }} {{ $rider->last_name }}</x-slot>
    <x-slot name="header">Rider Details</x-slot>

    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl lg:text-2xl font-bold text-gray-900">{{ $rider->first_name }} {{ $rider->last_name }}</h2>
                <p class="mt-1 text-sm text-gray-600">Registration #: {{ $rider->registration_number }}</p>
            </div>
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2">
                @can('update', $rider)
                <a href="{{ route('riders.edit', $rider) }}" class="inline-flex items-center justify-center px-4 py-2 bg-[#f2cc0d] text-[#181711] rounded-lg hover:bg-yellow-400 transition font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Rider
                </a>
                @endcan
                <a href="{{ route('riders.index') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Riders
                </a>
            </div>
        </div>
        
        @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif

        <!-- Status Banner -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-4 lg:px-6 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3
                    @if($rider->status === 'active') bg-green-50
                    @elseif($rider->status === 'pending') bg-yellow-50
                    @elseif($rider->status === 'suspended') bg-red-50
                    @else bg-gray-50 
                    @endif">
                    <div>
                        <h3 class="text-base lg:text-lg font-semibold text-gray-900">Status</h3>
                        <p class="text-sm text-gray-600">Current registration status</p>
                    </div>
                    <div>
                        @if($rider->status === 'pending')
                            <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Pending
                            </span>
                        @elseif($rider->status === 'active')
                            <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                Active
                            </span>
                        @elseif($rider->status === 'suspended')
                            <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                Suspended
                            </span>
                        @else
                            <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-full bg-gray-100 text-gray-800">
                                {{ ucfirst($rider->status) }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-6">

                <!-- Personal Information -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-10 h-10 bg-[#f2cc0d] rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#181711]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Personal Information</h3>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Full Name</dt>
                                <dd class="mt-1 text-sm text-gray-900 font-semibold">{{ $rider->first_name }} {{ $rider->last_name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">National ID</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $rider->national_id }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Date of Birth</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    @if($rider->date_of_birth)
                                        {{ $rider->date_of_birth->format('F j, Y') }} ({{ $rider->date_of_birth->age }} years old)
                                    @else
                                        Not provided
                                    @endif
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Phone Number</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $rider->phone_number }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Email Address</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $rider->email ?? 'Not provided' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Physical Address</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $rider->address }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Boda Stage</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    <a href="{{ route('stages.show', $rider->stage) }}" class="text-blue-600 hover:text-blue-800">
                                        {{ $rider->stage->name }}
                                    </a>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- License Information -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">License Information</h3>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">License Number</dt>
                                <dd class="mt-1 text-sm text-gray-900 font-semibold">{{ $rider->license_number }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">License Class</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $rider->license_class }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Issue Date</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $rider->license_issue_date ? $rider->license_issue_date->format('F j, Y') : 'Not provided' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Expiry Date</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    @if($rider->license_expiry_date)
                                        {{ $rider->license_expiry_date->format('F j, Y') }}
                                        @if($rider->license_expiry_date->isPast())
                                            <span class="ml-2 px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Expired</span>
                                        @elseif($rider->license_expiry_date->diffInDays() < 30)
                                            <span class="ml-2 px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Expiring Soon</span>
                                        @endif
                                    @else
                                        Not provided
                                    @endif
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Emergency Contact -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-red-50 to-orange-50 px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Emergency Contact</h3>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Contact Name</dt>
                                <dd class="mt-1 text-sm text-gray-900 font-semibold">{{ $rider->emergency_contact_name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Contact Phone</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $rider->emergency_contact_phone }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Relationship</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $rider->emergency_contact_relationship }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Motorcycle Information -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Motorcycle Information</h3>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        @if($rider->motorcycle)
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Plate Number</dt>
                                <dd class="mt-1 text-sm text-gray-900 font-semibold">{{ $rider->motorcycle->registration_number }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Make/Brand</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $rider->motorcycle->make }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Model</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $rider->motorcycle->model }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Year</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $rider->motorcycle->year }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Color</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $rider->motorcycle->color }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Engine Number</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $rider->motorcycle->engine_number }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Chassis Number</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $rider->motorcycle->chassis_number }}</dd>
                            </div>
                        </dl>
                        @else
                        <p class="text-sm text-gray-500">No motorcycle information available.</p>
                        @endif
                    </div>
                </div>
            </div>

        <!-- Registration Details -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Registration Details</h3>
                </div>
                <div class="p-6">
                    <dl class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Registration Number</dt>
                            <dd class="mt-1 text-sm text-gray-900 font-semibold">{{ $rider->registration_number }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Registration Date</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $rider->created_at->format('F j, Y') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $rider->updated_at->format('F j, Y') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
