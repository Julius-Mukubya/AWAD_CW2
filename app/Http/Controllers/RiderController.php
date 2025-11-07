<?php

namespace App\Http\Controllers;

use App\Models\Rider;
use App\Models\Stage;
use Illuminate\Http\Request;

class RiderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Rider::with(['stage', 'motorcycle']);

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('registration_number', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Stage filter
        if ($request->filled('stage_id')) {
            $query->where('stage_id', $request->stage_id);
        }

        $riders = $query->paginate(10)->withQueryString();
        
        return view('riders.index', compact('riders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stages = Stage::all();
        return view('riders.create', compact('stages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nin' => 'required|string|max:255|unique:riders,national_id',
            'date_of_birth' => 'required|date|before:-18 years',
            'phone_number' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string',
            'license_number' => 'required|string|max:255',
            'license_class' => 'required|string|max:10',
            'license_issue_date' => 'required|date|before_or_equal:today',
            'license_expiry_date' => 'required|date|after:today',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:20',
            'emergency_contact_relationship' => 'required|string|max:255',
            'stage_id' => 'required|exists:stages,id',
            'status' => 'required|in:pending,active,inactive,suspended',
            'motorcycle.plate_number' => 'required|string|max:255|unique:motorcycles,registration_number',
            'motorcycle.make' => 'required|string|max:255',
            'motorcycle.model' => 'required|string|max:255',
            'motorcycle.year' => 'required|integer|min:1990|max:' . (date('Y') + 1),
            'motorcycle.color' => 'required|string|max:255',
            'motorcycle.engine_number' => 'required|string|max:255',
            'motorcycle.chassis_number' => 'required|string|max:255',
        ]);

        // Split name into first and last name
        $nameParts = explode(' ', $validated['name'], 2);
        $firstName = $nameParts[0];
        $lastName = $nameParts[1] ?? '';

        // Generate registration number
        $registrationNumber = 'BR' . date('Y') . str_pad(Rider::count() + 1, 6, '0', STR_PAD_LEFT);

        // Create rider
        $rider = Rider::create([
            'registration_number' => $registrationNumber,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'national_id' => $validated['nin'],
            'date_of_birth' => $validated['date_of_birth'],
            'phone_number' => $validated['phone_number'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'license_number' => $validated['license_number'],
            'license_issue_date' => $validated['license_issue_date'],
            'license_expiry_date' => $validated['license_expiry_date'],
            'license_class' => $validated['license_class'],
            'emergency_contact_name' => $validated['emergency_contact_name'],
            'emergency_contact_phone' => $validated['emergency_contact_phone'],
            'emergency_contact_relationship' => $validated['emergency_contact_relationship'],
            'stage_id' => $validated['stage_id'],
            'status' => $validated['status'],
        ]);

        // Create motorcycle
        $rider->motorcycle()->create([
            'registration_number' => $validated['motorcycle']['plate_number'],
            'make' => $validated['motorcycle']['make'],
            'model' => $validated['motorcycle']['model'],
            'year' => $validated['motorcycle']['year'],
            'engine_number' => $validated['motorcycle']['engine_number'],
            'chassis_number' => $validated['motorcycle']['chassis_number'],
            'color' => $validated['motorcycle']['color'],
        ]);

        return redirect()
            ->route('riders.index')
            ->with('success', 'Rider registered successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rider  $rider
     * @return \Illuminate\Http\Response
     */
    public function show(Rider $rider)
    {
        $rider->load(['stage', 'motorcycle']);
        return view('riders.show', compact('rider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rider  $rider
     * @return \Illuminate\Http\Response
     */
    public function edit(Rider $rider)
    {
        $stages = Stage::all();
        return view('riders.edit', compact('rider', 'stages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rider  $rider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rider $rider)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nin' => 'required|string|max:255|unique:riders,national_id,' . $rider->id,
            'date_of_birth' => 'required|date|before:-18 years',
            'phone_number' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string',
            'license_number' => 'required|string|max:255',
            'license_class' => 'required|string|max:10',
            'license_issue_date' => 'required|date|before_or_equal:today',
            'license_expiry_date' => 'required|date|after:today',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:20',
            'emergency_contact_relationship' => 'required|string|max:255',
            'stage_id' => 'required|exists:stages,id',
            'status' => 'required|in:pending,active,inactive,suspended',
            'motorcycle.plate_number' => 'required|string|max:255',
            'motorcycle.make' => 'required|string|max:255',
            'motorcycle.model' => 'required|string|max:255',
            'motorcycle.year' => 'required|integer|min:1990|max:' . (date('Y') + 1),
            'motorcycle.color' => 'required|string|max:255',
            'motorcycle.engine_number' => 'required|string|max:255',
            'motorcycle.chassis_number' => 'required|string|max:255',
        ]);

        // Split name into first and last name
        $nameParts = explode(' ', $validated['name'], 2);
        $firstName = $nameParts[0];
        $lastName = $nameParts[1] ?? '';

        // Update rider
        $rider->update([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'national_id' => $validated['nin'],
            'date_of_birth' => $validated['date_of_birth'],
            'phone_number' => $validated['phone_number'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'license_number' => $validated['license_number'],
            'license_issue_date' => $validated['license_issue_date'],
            'license_expiry_date' => $validated['license_expiry_date'],
            'license_class' => $validated['license_class'],
            'emergency_contact_name' => $validated['emergency_contact_name'],
            'emergency_contact_phone' => $validated['emergency_contact_phone'],
            'emergency_contact_relationship' => $validated['emergency_contact_relationship'],
            'stage_id' => $validated['stage_id'],
            'status' => $validated['status'],
        ]);

        // Update motorcycle
        $rider->motorcycle()->updateOrCreate(
            ['rider_id' => $rider->id],
            [
                'registration_number' => $validated['motorcycle']['plate_number'],
                'make' => $validated['motorcycle']['make'],
                'model' => $validated['motorcycle']['model'],
                'year' => $validated['motorcycle']['year'],
                'engine_number' => $validated['motorcycle']['engine_number'],
                'chassis_number' => $validated['motorcycle']['chassis_number'],
                'color' => $validated['motorcycle']['color'],
            ]
        );

        return redirect()
            ->route('riders.show', $rider)
            ->with('success', 'Rider updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rider  $rider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rider $rider)
    {
        $rider->delete();

        return redirect()
            ->route('riders.index')
            ->with('success', 'Rider deleted successfully.');
    }
}
