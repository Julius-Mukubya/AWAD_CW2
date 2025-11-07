@extends('layouts.guest')

@section('content')
<main class="flex flex-1 flex-col">
    <div class="container mx-auto flex flex-col gap-8 px-4 py-10">
        <!-- Page Heading -->
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex flex-col gap-2">
                <p class="text-4xl font-black leading-tight tracking-[-0.033em] text-[#181711] dark:text-white">
                    Registered Riders
                </p>
                <p class="text-base font-normal leading-normal text-gray-500 dark:text-gray-400">
                    Find registered Boda Bodas and their official stages across Kampala.
                </p>
            </div>
        </div>

        <!-- Search and Filter Bar -->
        <div class="bg-white dark:bg-black/20 rounded-lg shadow-sm p-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Search Input -->
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search</label>
                    <div class="flex h-12 w-full items-stretch rounded-lg border border-gray-300 dark:border-gray-600 overflow-hidden">
                        <div class="flex items-center justify-center bg-gray-50 dark:bg-black/30 pl-4 pr-3 text-gray-500 dark:text-gray-400">
                            <span class="material-symbols-outlined">search</span>
                        </div>
                        <input id="riders-search" onkeyup="filterRiders()"
                            class="form-input h-full flex-1 border-none bg-white dark:bg-black/20 px-4 text-base text-[#181711] dark:text-white placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:outline-0 focus:ring-0"
                            placeholder="Search by name or registration number..." value="" />
                    </div>
                </div>

                <!-- Stage Filter Dropdown -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Stage</label>
                    <select id="stage-select" onchange="filterByStageSelect(this.value)" 
                        class="w-full h-12 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-black/20 text-[#181711] dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">All Stages</option>
                        @foreach($stages as $stage)
                            <option value="{{ $stage->id }}" {{ request('stage') == $stage->id ? 'selected' : '' }}>
                                {{ $stage->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Button -->
                <div class="flex items-end gap-2">
                    <!-- Apply Filter Button -->
                    <button onclick="applyFilters()" 
                        class="w-full h-12 flex items-center justify-center gap-2 rounded-lg bg-[#f2cc0d] hover:bg-yellow-400 text-[#181711] font-medium transition-all duration-200 shadow-sm hover:shadow-md">
                        <span class="material-symbols-outlined">filter_alt</span>
                        <span>Filter Results</span>
                    </button>
                    <!-- Optional Search Button -->
                    <button onclick="filterRiders()" 
                        class="w-full h-12 flex items-center justify-center rounded-lg bg-[#f2cc0d] hover:bg-yellow-400 text-[#181711] font-medium transition-all duration-200 shadow-sm hover:shadow-md">
                        <span class="material-symbols-outlined">search</span>
                        <span>Search</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Riders Table -->
        <div class="overflow-x-auto bg-white dark:bg-black/20 rounded-lg shadow-sm mt-6">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Reg. Number</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Stage</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Phone</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Status</th>
                    </tr>
                </thead>
                <tbody id="riders-grid" class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($riders as $rider)
                    <tr class="rider-card" 
                        data-reg="{{ strtolower($rider->registration_number) }}" 
                        data-name="{{ strtolower($rider->first_name . ' ' . $rider->last_name) }}" 
                        data-stage="{{ $rider->stage_id }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ $rider->registration_number }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $rider->first_name }} {{ $rider->last_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ $rider->stage->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary"><a href="tel:{{ $rider->phone_number }}">{{ $rider->phone_number }}</a></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 rounded-full bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-xs font-semibold">Active</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- No Results -->
        <div id="no-results" class="hidden flex flex-col items-center justify-center gap-4 rounded-lg bg-white dark:bg-black/20 p-12 text-center mt-6">
            <span class="material-symbols-outlined text-5xl text-gray-400">search_off</span>
            <p class="text-lg font-semibold text-[#181711] dark:text-white">No Results Found</p>
            <p class="text-gray-500 dark:text-gray-400">No Boda Bodas found matching your criteria. Try a different search or filter.</p>
        </div>
    </div>
</main>

<script>
let currentStageFilter = '{{ request("stage") ?? "" }}';
const searchInput = document.getElementById('riders-search');
const stageSelect = document.getElementById('stage-select');

function filterRiders() {
    const searchTerm = searchInput.value.toLowerCase();
    const riderCards = document.querySelectorAll('.rider-card');
    let visibleCount = 0;

    riderCards.forEach(row => {
        const regNumber = row.dataset.reg;
        const name = row.dataset.name;
        const stageId = row.dataset.stage;

        const matchesSearch = regNumber.includes(searchTerm) || name.includes(searchTerm);
        const matchesStage = !currentStageFilter || stageId === currentStageFilter;

        if (matchesSearch && matchesStage) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });

    document.getElementById('no-results').style.display = (visibleCount === 0 && riderCards.length > 0) ? 'flex' : 'none';
}

function filterByStage(stageId) {
    currentStageFilter = stageId;
    stageSelect.value = stageId;
    filterRiders();
}

function filterByStageSelect(stageId) {
    filterByStage(stageId);
}

function applyFilters() {
    const selectedStage = stageSelect.value;
    filterByStage(selectedStage);
}

document.addEventListener('DOMContentLoaded', () => {
    if (currentStageFilter) filterByStage(currentStageFilter);
    searchInput.addEventListener('input', filterRiders);
});
</script>
@endsection
