<?php

namespace App\Http\Controllers;

use App\Models\Rider;
use App\Models\Stage;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function directory()
    {
        // Only show active riders with non-sensitive information
        $riders = Rider::with('stage')
            ->where('status', 'active')
            ->select('id', 'registration_number', 'first_name', 'last_name', 'stage_id', 'status', 'phone_number')
            ->orderBy('registration_number')
            ->get();

        // Get all stages with rider count (only count active riders for public display)
        $stages = Stage::withCount(['riders' => function ($query) {
                $query->where('status', 'active');
            }])
            ->orderBy('name')
            ->get();

        return view('public.directory', compact('riders', 'stages'));
    }

    public function stages()
    {
        // Get all stages with active rider count
        $stages = Stage::withCount(['riders' => function ($query) {
                $query->where('status', 'active');
            }])
            ->orderBy('name')
            ->get();

        return view('public.stages', compact('stages'));
    }

    public function riders(Request $request)
    {
        // Only show active riders with non-sensitive information
        $query = Rider::with('stage')
            ->where('status', 'active')
            ->select('id', 'registration_number', 'first_name', 'last_name', 'stage_id', 'status', 'phone_number');

        // Filter by stage if provided
        if ($request->filled('stage')) {
            $query->where('stage_id', $request->stage);
        }

        $riders = $query->orderBy('registration_number')->get();

        // Get all stages for filter dropdown
        $stages = Stage::withCount(['riders' => function ($query) {
                $query->where('status', 'active');
            }])
            ->orderBy('name')
            ->get();

        return view('riders', compact('riders', 'stages'));
    }
}
