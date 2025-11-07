<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rider;
use App\Models\Stage;

class ReportsController extends Controller
{
    public function index()
    {
        return view('reports.index', [
            'totalRiders' => Rider::count(),
            'activeRiders' => Rider::where('status', 'active')->count(),
            'stages' => Stage::withCount('riders')->get(),
        ]);
    }
}