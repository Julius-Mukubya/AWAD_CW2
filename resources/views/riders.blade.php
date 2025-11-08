@extends('layouts.guest')

@section('content')
<main class="w-full">
    <!-- Hero Section -->
    <section class="w-full">
        <div class="@container">
            <div class="flex min-h-[400px] flex-col gap-6 bg-cover bg-center bg-no-repeat @[480px]:gap-8 items-center justify-center p-4 text-center"
                data-alt="Kampala boda boda riders directory"
                style='background-image: linear-gradient(rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.6) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuAmrUfO4yBAvAl9qVaZnnuB4zKDM62F4iI_RndonH9VTjlTd6fQMkDwwFYmqMKCWXRArC_R6zd9n86DhyD4m1k5Ifucyyn1uOnxO1BGFPKBhK6IJqBcDAbx5wO2wsz_nPKf9KApfeTBrxknou3mVfj5FZ10MhpbN7roIEfvPQU1pA8l6wQe3m5wFnWWuzjPah1tGV-gM6DgqGiGMU6X5YhangmXho5WUrD1l9YrthEC5Ca881z1alLgH0VpfAhfumavn8cF2q9tcRg");'>
                <div class="flex flex-col gap-4 max-w-3xl items-center text-center">
                    <h1 class="text-white text-4xl font-black leading-tight tracking-[-0.033em] @[480px]:text-5xl">
                        Registered Riders
                    </h1>
                    <h2 class="text-white/90 text-sm font-normal leading-normal @[480px]:text-base">
                        Find registered Boda Bodas and their official stages across Kampala.
                    </h2>
                </div>
            </div>
        </div>
    </section>

    <div class="container mx-auto flex flex-col gap-8 px-4 py-10">
        <!-- Success Message -->
        @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center">
            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
        @endif

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

                <!-- Sort Dropdown -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Sort By</label>
                    <select id="sort-select" onchange="sortRiders(this.value)" 
                        class="w-full h-12 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-black/20 text-[#181711] dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="reg-asc">Reg. Number (A-Z)</option>
                        <option value="reg-desc">Reg. Number (Z-A)</option>
                        <option value="name-asc">Name (A-Z)</option>
                        <option value="name-desc">Name (Z-A)</option>
                        <option value="stage-asc">Stage (A-Z)</option>
                        <option value="stage-desc">Stage (Z-A)</option>
                        <option value="status-asc">Status (A-Z)</option>
                        <option value="status-desc">Status (Z-A)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Riders Table -->
        <div class="overflow-x-auto bg-white dark:bg-black/20 rounded-lg shadow-sm mt-6">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700" onclick="sortByColumn('reg')">
                            <div class="flex items-center gap-2">
                                Reg. Number
                                <span class="material-symbols-outlined text-sm">unfold_more</span>
                            </div>
                        </th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700" onclick="sortByColumn('name')">
                            <div class="flex items-center gap-2">
                                Name
                                <span class="material-symbols-outlined text-sm">unfold_more</span>
                            </div>
                        </th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700" onclick="sortByColumn('stage')">
                            <div class="flex items-center gap-2">
                                Stage
                                <span class="material-symbols-outlined text-sm">unfold_more</span>
                            </div>
                        </th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Phone</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700" onclick="sortByColumn('status')">
                            <div class="flex items-center gap-2">
                                Status
                                <span class="material-symbols-outlined text-sm">unfold_more</span>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody id="riders-grid" class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($riders as $rider)
                    <tr class="rider-card" 
                        data-reg="{{ strtolower($rider->registration_number) }}" 
                        data-name="{{ strtolower($rider->first_name . ' ' . $rider->last_name) }}" 
                        data-stage="{{ $rider->stage_id }}"
                        data-stage-name="{{ strtolower($rider->stage->name) }}"
                        data-status="{{ strtolower($rider->status) }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ $rider->registration_number }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $rider->first_name }} {{ $rider->last_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ $rider->stage->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary"><a href="tel:{{ $rider->phone_number }}">{{ $rider->phone_number }}</a></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($rider->status === 'active')
                                <span class="px-3 py-1 rounded-full bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-xs font-semibold">Active</span>
                            @elseif($rider->status === 'pending')
                                <span class="px-3 py-1 rounded-full bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 text-xs font-semibold">Pending</span>
                            @else
                                <span class="px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 text-xs font-semibold">{{ ucfirst($rider->status) }}</span>
                            @endif
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
let currentSortColumn = 'reg';
let currentSortDirection = 'asc';
const searchInput = document.getElementById('riders-search');
const stageSelect = document.getElementById('stage-select');
const sortSelect = document.getElementById('sort-select');
const ridersGrid = document.getElementById('riders-grid');

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

function sortRiders(sortValue) {
    const [column, direction] = sortValue.split('-');
    currentSortColumn = column;
    currentSortDirection = direction;
    
    const rows = Array.from(document.querySelectorAll('.rider-card'));
    
    rows.sort((a, b) => {
        let aValue, bValue;
        
        switch(column) {
            case 'reg':
                aValue = a.dataset.reg;
                bValue = b.dataset.reg;
                break;
            case 'name':
                aValue = a.dataset.name;
                bValue = b.dataset.name;
                break;
            case 'stage':
                aValue = a.dataset.stageName;
                bValue = b.dataset.stageName;
                break;
            case 'status':
                aValue = a.dataset.status;
                bValue = b.dataset.status;
                break;
            default:
                return 0;
        }
        
        if (direction === 'asc') {
            return aValue.localeCompare(bValue);
        } else {
            return bValue.localeCompare(aValue);
        }
    });
    
    // Re-append rows in sorted order
    rows.forEach(row => ridersGrid.appendChild(row));
    
    // Re-apply filters after sorting
    filterRiders();
}

function sortByColumn(column) {
    // Toggle direction if clicking the same column
    if (currentSortColumn === column) {
        currentSortDirection = currentSortDirection === 'asc' ? 'desc' : 'asc';
    } else {
        currentSortColumn = column;
        currentSortDirection = 'asc';
    }
    
    const sortValue = `${column}-${currentSortDirection}`;
    sortSelect.value = sortValue;
    sortRiders(sortValue);
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
