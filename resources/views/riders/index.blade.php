<x-admin-layout>
    <x-slot name="title">Riders Management</x-slot>
    <x-slot name="header">Riders</x-slot>

           <!-- Page Content -->
            <div class="space-y-6">
                
                <!-- Header with Add Button -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h3 class="text-lg lg:text-xl font-semibold text-gray-900">All Riders</h3>
                        <p class="text-sm text-gray-600 mt-1">Manage and view all registered bodaboda riders</p>
                    </div>
                    @can('create', \App\Models\Rider::class)
                    <a href="{{ route('riders.create') }}" class="bg-[#f2cc0d] hover:bg-yellow-400 text-[#181711] font-semibold py-2 px-4 lg:px-6 rounded-lg shadow text-center whitespace-nowrap">
                        + Add New Rider
                    </a>
                    @endcan
                </div>

                <!-- Search and Filter Bar -->
                <form action="{{ route('riders.index') }}" method="GET" class="bg-white rounded-lg shadow p-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                            <input type="text" name="search" value="{{ request('search') }}" 
                                placeholder="Search by name, registration..." 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#f2cc0d] focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#f2cc0d] focus:border-transparent">
                                <option value="">All Status</option>
                                @foreach(['active', 'pending', 'suspended', 'inactive'] as $status)
                                    <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Stage</label>
                            <select name="stage_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#f2cc0d] focus:border-transparent">
                                <option value="">All Stages</option>
                                @foreach(\App\Models\Stage::all() as $stage)
                                    <option value="{{ $stage->id }}" {{ request('stage_id') == $stage->id ? 'selected' : '' }}>
                                        {{ $stage->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 flex flex-col sm:flex-row justify-end gap-2">
                        @if(request()->hasAny(['search', 'status', 'stage_id']))
                        <a href="{{ route('riders.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 font-medium text-center">
                            Clear Filters
                        </a>
                        @endif
                        <button type="submit" class="bg-[#f2cc0d] text-[#181711] px-4 py-2 rounded-lg hover:bg-yellow-400 font-medium">
                            Filter Results
                        </button>
                    </div>
                </form>
                
                <!-- Riders Table -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Registration
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Contact
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Stage
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($riders as $rider)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0">
                                                @php
                                                    $colors = ['blue', 'green', 'purple', 'orange', 'pink'];
                                                    $color = $colors[($rider->id % count($colors))];
                                                    $initials = strtoupper(substr($rider->first_name, 0, 1) . substr($rider->last_name, 0, 1));
                                                @endphp
                                                <div class="h-10 w-10 rounded-full bg-{{ $color }}-500 flex items-center justify-center text-white font-semibold">
                                                    {{ $initials }}
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $rider->first_name }} {{ $rider->last_name }}</div>
                                                <div class="text-xs text-gray-500">Reg: {{ $rider->registration_number }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $rider->registration_number }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $rider->phone_number }}</div>
                                        <div class="text-xs text-gray-500">{{ $rider->email ?? 'N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $rider->stage->name ?? 'N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusColors = [
                                                'active' => 'green',
                                                'pending' => 'yellow',
                                                'suspended' => 'red',
                                                'inactive' => 'gray'
                                            ];
                                            $color = $statusColors[$rider->status] ?? 'gray';
                                        @endphp
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $color }}-100 text-{{ $color }}-800">
                                            {{ ucfirst($rider->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-right">
                                        <a href="{{ route('riders.show', $rider) }}" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                        <a href="{{ route('riders.edit', $rider) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                        <form action="{{ route('riders.destroy', $rider) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" 
                                                onclick="return confirm('Are you sure you want to delete this rider?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                        No riders found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($riders->hasPages())
                    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1 flex justify-between sm:hidden">
                                @if($riders->onFirstPage())
                                    <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-400 bg-gray-100 cursor-not-allowed">
                                        Previous
                                    </span>
                                @else
                                    <a href="{{ $riders->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        Previous
                                    </a>
                                @endif
                                
                                @if($riders->hasMorePages())
                                    <a href="{{ $riders->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        Next
                                    </a>
                                @else
                                    <span class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-400 bg-gray-100 cursor-not-allowed">
                                        Next
                                    </span>
                                @endif
                            </div>
                            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-sm text-gray-700">
                                        Showing <span class="font-medium">{{ $riders->firstItem() }}</span> to <span class="font-medium">{{ $riders->lastItem() }}</span> of <span class="font-medium">{{ $riders->total() }}</span> results
                                    </p>
                                </div>
                                <div>
                                    {{ $riders->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                
            </div>
        
    
</x-admin-layout>

@push('scripts')
<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this rider?');
    }
</script>
@endpush