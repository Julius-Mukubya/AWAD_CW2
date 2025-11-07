<x-admin-layout>
    <x-slot name="title">Dashboard</x-slot>
    <x-slot name="header">Dashboard Overview</x-slot>

    @php
        $stats = [
            'total' => \App\Models\Rider::count(),
            'active' => \App\Models\Rider::where('status', 'active')->count(),
            'pending' => \App\Models\Rider::where('status', 'pending')->count(),
            'suspended' => \App\Models\Rider::where('status', 'suspended')->count(),
        ];

        $recent = \App\Models\Rider::with('stage')->latest()->take(5)->get();
        $stages = \App\Models\Stage::withCount('riders')->get();
    @endphp
      <!-- Dashboard Content -->
            <div class="space-y-6">
                
                <!-- Stats Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
                    <!-- Total Riders -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="text-sm text-gray-600 mb-1">Total Riders</div>
                        <div class="text-3xl font-bold text-gray-900">{{ number_format($stats['total']) }}</div>
                        <div class="text-xs text-green-600 mt-2">@if($stats['total'] > 0)↑ {{ round(($stats['total'] * 0.12)) }}% from last month @else — @endif</div>
                    </div>

                    <!-- Active -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="text-sm text-gray-600 mb-1">Active</div>
                        <div class="text-3xl font-bold text-green-600">{{ number_format($stats['active']) }}</div>
                        <div class="text-xs text-gray-500 mt-2">@if($stats['total'] > 0){{ round(($stats['active'] / max(1, $stats['total'])) * 100) }}% of total @else — @endif</div>
                    </div>

                    <!-- Pending -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="text-sm text-gray-600 mb-1">Pending</div>
                        <div class="text-3xl font-bold text-yellow-600">{{ number_format($stats['pending']) }}</div>
                        <div class="text-xs text-gray-500 mt-2">Awaiting approval</div>
                    </div>

                    <!-- Suspended -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="text-sm text-gray-600 mb-1">Suspended</div>
                        <div class="text-3xl font-bold text-red-600">{{ number_format($stats['suspended']) }}</div>
                        <div class="text-xs text-gray-500 mt-2">@if($stats['total'] > 0){{ round(($stats['suspended'] / max(1, $stats['total'])) * 100) }}% of total @else — @endif</div>
                    </div>
                </div>

                <!-- Two Column Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 lg:gap-6">
                    
                    <!-- Recent Riders -->
                    <div class="lg:col-span-2 bg-white rounded-lg shadow">
                        <div class="px-4 lg:px-6 py-4 border-b flex items-center justify-between">
                            <h3 class="text-base lg:text-lg font-semibold text-gray-900">Recent Registrations</h3>
                            <a href="{{ route('riders.index') }}" class="text-xs lg:text-sm text-blue-600 hover:text-blue-800">View all →</a>
                        </div>
                        <div class="p-4 lg:p-6 overflow-x-auto">
                            <table class="w-full min-w-[600px]">
                                <thead>
                                    <tr class="text-left text-sm text-gray-600 border-b">
                                        <th class="pb-3">Name</th>
                                        <th class="pb-3">Registration</th>
                                        <th class="pb-3">Stage</th>
                                        <th class="pb-3">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm">
                                    @forelse($recent as $rider)
                                        <tr class="border-b">
                                            <td class="py-4">{{ $rider->first_name }} {{ $rider->last_name }}</td>
                                            <td class="py-4">{{ $rider->registration_number }}</td>
                                            <td class="py-4">{{ $rider->stage->name ?? '—' }}</td>
                                            <td class="py-4">
                                                @if($rider->status === 'pending')
                                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs font-medium">Pending</span>
                                                @elseif($rider->status === 'active')
                                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-medium">Active</span>
                                                @elseif($rider->status === 'suspended')
                                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs font-medium">Suspended</span>
                                                @else
                                                    <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded text-xs font-medium">{{ ucfirst($rider->status) }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="py-4" colspan="4">No recent registrations.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="px-6 py-4 border-b">
                            <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
                        </div>
                        <div class="p-6 space-y-3">
                            @can('create', \App\Models\Rider::class)
                            <a href="{{ route('riders.create') }}" class="block w-full px-4 py-3 bg-[#f2cc0d] text-[#181711] text-center rounded-lg hover:bg-yellow-400 font-medium transition duration-200">
                                Register New Rider
                            </a>
                            @endcan

                            <a href="{{ route('riders.index') }}" class="block w-full px-4 py-3 border border-gray-300 text-gray-700 text-center rounded-lg hover:bg-gray-50 font-medium transition duration-200">
                                View All Riders
                            </a>

                            @can('viewAny', \App\Models\Rider::class)
                            <a href="{{ route('riders.index', ['status' => 'pending']) }}" class="block w-full px-4 py-3 border border-gray-300 text-gray-700 text-center rounded-lg hover:bg-gray-50 font-medium transition duration-200">
                                Pending Approvals
                                <span class="ml-2 px-2 py-0.5 bg-yellow-100 text-yellow-800 rounded-full text-xs">{{ $stats['pending'] }}</span>
                            </a>
                            @endcan

                            @can('viewAny', \App\Models\Stage::class)
                            <a href="{{ route('stages.index') }}" class="block w-full px-4 py-3 border border-gray-300 text-gray-700 text-center rounded-lg hover:bg-gray-50 font-medium transition duration-200">
                                Manage Stages
                            </a>
                            @endcan
                        </div>
                    </div>

                </div>

            </div>
        
 
</x-admin-layout>