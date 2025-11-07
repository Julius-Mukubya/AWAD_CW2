<?php

namespace App\Http\Controllers;

use App\Models\Rider;
use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRiders = Rider::count();
        $activeRiders = Rider::where('status', 'active')->count();
        $pendingRiders = Rider::where('status', 'pending')->count();
        $suspendedRiders = Rider::where('status', 'suspended')->count();
        
        $recentRiders = Rider::with('stage')
            ->latest()
            ->take(5)
            ->get();
        
        // Get riders count by stage (for admin only)
        $ridersByStage = collect();
        if (auth()->user()->isAdmin()) {
            $ridersByStage = Rider::select('stage_id', DB::raw('count(*) as total'))
                ->with('stage')
                ->groupBy('stage_id')
                ->orderByDesc('total')
                ->take(5)
                ->get();
        }
        
        return view('dashboard', compact(
            'totalRiders',
            'activeRiders',
            'pendingRiders',
            'suspendedRiders',
            'recentRiders',
            'ridersByStage'
        ));
    }
}