<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use Illuminate\Http\Request;

class StageController extends Controller
{
    public function index()
    {
        return view('stages.index');
    }

    public function create()
    {
        $this->authorize('create', Stage::class);
        return view('stages.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Stage::class);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'district' => 'nullable|string|max:255',
        ]);

        Stage::create($validated);

        return redirect()->route('stages.index')->with('success', 'Stage created successfully.');
    }

    public function show(Stage $stage)
    {
        $stage->load('riders');
        return view('stages.show', compact('stage'));
    }

    public function edit(Stage $stage)
    {
        $this->authorize('update', $stage);
        return view('stages.edit', compact('stage'));
    }

    public function update(Request $request, Stage $stage)
    {
        $this->authorize('update', $stage);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'district' => 'nullable|string|max:255',
        ]);

        $stage->update($validated);

        return redirect()->route('stages.index')->with('success', 'Stage updated successfully.');
    }

    public function destroy(Stage $stage)
    {
        $this->authorize('delete', $stage);
        
        if ($stage->riders()->count() > 0) {
            return redirect()->route('stages.index')->with('error', 'Cannot delete stage with registered riders.');
        }

        $stage->delete();

        return redirect()->route('stages.index')->with('success', 'Stage deleted successfully.');
    }
}
