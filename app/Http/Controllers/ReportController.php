<?php

namespace App\Http\Controllers;

use App\Models\Rider;
use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function riders(Request $request)
    {
        $query = Rider::with(['stage', 'motorcycle']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by stage
        if ($request->filled('stage_id')) {
            $query->where('stage_id', $request->stage_id);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $riders = $query->orderBy('created_at', 'desc')->get();
        $stages = Stage::all();

        return view('reports.riders', compact('riders', 'stages'));
    }

    public function stages()
    {
        $stages = Stage::withCount([
            'riders',
            'riders as active_riders_count' => function ($query) {
                $query->where('status', 'active');
            },
            'riders as pending_riders_count' => function ($query) {
                $query->where('status', 'pending');
            },
            'riders as suspended_riders_count' => function ($query) {
                $query->where('status', 'suspended');
            }
        ])->get();

        return view('reports.stages', compact('stages'));
    }

    public function statistics()
    {
        $totalRiders = Rider::count();
        $activeRiders = Rider::where('status', 'active')->count();
        $pendingRiders = Rider::where('status', 'pending')->count();
        $suspendedRiders = Rider::where('status', 'suspended')->count();
        $totalStages = Stage::count();

        // Riders by stage
        $ridersByStage = Stage::withCount('riders')
            ->orderBy('riders_count', 'desc')
            ->get();

        // Monthly registrations (last 12 months)
        $monthlyRegistrations = Rider::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('count(*) as count')
        )
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('reports.statistics', compact(
            'totalRiders',
            'activeRiders',
            'pendingRiders',
            'suspendedRiders',
            'totalStages',
            'ridersByStage',
            'monthlyRegistrations'
        ));
    }
}
