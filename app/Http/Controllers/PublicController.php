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
        // Show active and pending riders with non-sensitive information
        $query = Rider::with('stage')
            ->whereIn('status', ['active', 'pending'])
            ->select('id', 'registration_number', 'first_name', 'last_name', 'stage_id', 'status', 'phone_number');

        // Filter by stage if provided
        if ($request->filled('stage')) {
            $query->where('stage_id', $request->stage);
        }

        $riders = $query->orderBy('registration_number')->get();

        // Get all stages for filter dropdown
        $stages = Stage::withCount(['riders' => function ($query) {
                $query->whereIn('status', ['active', 'pending']);
            }])
            ->orderBy('name')
            ->get();

        return view('riders', compact('riders', 'stages'));
    }

    public function selfRegister(Request $request)
    {
        $stages = Stage::orderBy('name')->get();
        
        // Check if user has already registered
        $existingRider = null;
        
        // Check if authenticated user has a rider record by user_id
        if (auth()->check()) {
            $existingRider = Rider::with(['stage', 'motorcycle'])
                ->where('user_id', auth()->id())
                ->first();
        }
        
        return view('self-register', compact('stages', 'existingRider'));
    }

    public function storeSelfRegistration(Request $request)
    {
        // Check if current user already has a registration
        $existingRider = Rider::where('user_id', auth()->id())->first();
            
        if ($existingRider) {
            return redirect()->route('self-register')
                ->with('info', 'You have already submitted a registration. Your application status is: ' . ucfirst($existingRider->status));
        }
        
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'national_id' => 'required|string|max:255|unique:riders,national_id',
            'date_of_birth' => 'required|date|before:-18 years',
            'phone_number' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string',
            'stage_id' => 'required|exists:stages,id',
            'license_number' => 'required|string|max:255',
            'license_class' => 'required|string|max:10',
            'license_issue_date' => 'required|date|before_or_equal:today',
            'license_expiry_date' => 'nullable|date|after:today',
            'motorcycle_registration_number' => 'required|string|max:255',
            'motorcycle_make' => 'required|string|max:255',
            'motorcycle_model' => 'required|string|max:255',
            'motorcycle_year' => 'required|integer|min:1990|max:' . date('Y'),
            'motorcycle_color' => 'required|string|max:255',
            'motorcycle_engine_number' => 'required|string|max:255',
            'motorcycle_chassis_number' => 'required|string|max:255',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:20',
            'emergency_contact_relationship' => 'required|string|max:255',
        ]);

        // Generate registration number
        $lastRider = Rider::latest('id')->first();
        $nextNumber = $lastRider ? (intval(substr($lastRider->registration_number, 3)) + 1) : 1;
        $registrationNumber = 'KBB' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

        // Create rider with pending status
        $rider = Rider::create([
            'user_id' => auth()->id(),
            'registration_number' => $registrationNumber,
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'national_id' => $validated['national_id'],
            'date_of_birth' => $validated['date_of_birth'],
            'phone_number' => $validated['phone_number'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'stage_id' => $validated['stage_id'],
            'license_number' => $validated['license_number'],
            'license_class' => $validated['license_class'],
            'license_issue_date' => $validated['license_issue_date'],
            'license_expiry_date' => $validated['license_expiry_date'],
            'emergency_contact_name' => $validated['emergency_contact_name'],
            'emergency_contact_phone' => $validated['emergency_contact_phone'],
            'emergency_contact_relationship' => $validated['emergency_contact_relationship'],
            'status' => 'pending', // Set status to pending for self-registration
        ]);

        // Create motorcycle record
        $rider->motorcycle()->create([
            'registration_number' => $validated['motorcycle_registration_number'],
            'make' => $validated['motorcycle_make'],
            'model' => $validated['motorcycle_model'],
            'year' => $validated['motorcycle_year'],
            'color' => $validated['motorcycle_color'],
            'engine_number' => $validated['motorcycle_engine_number'],
            'chassis_number' => $validated['motorcycle_chassis_number'],
        ]);

        return redirect()->route('self-register')->with('success', 'Registration submitted successfully! Your application is pending approval. You will be notified once approved.');
    }
    
    public function updateSelfRegistration(Request $request, Rider $rider)
    {
        // Only allow updates if status is pending
        if ($rider->status !== 'pending') {
            return redirect()->route('self-register')
                ->with('info', 'Your application has already been processed and cannot be edited.');
        }
        
        // Verify the user owns this registration (by user_id)
        if ($rider->user_id !== auth()->id()) {
            return redirect()->route('self-register')
                ->with('info', 'You can only edit your own registration.');
        }
        
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'national_id' => 'required|string|max:255|unique:riders,national_id,' . $rider->id,
            'date_of_birth' => 'required|date|before:-18 years',
            'phone_number' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string',
            'stage_id' => 'required|exists:stages,id',
            'license_number' => 'required|string|max:255',
            'license_class' => 'required|string|max:10',
            'license_issue_date' => 'required|date|before_or_equal:today',
            'license_expiry_date' => 'nullable|date|after:today',
            'motorcycle_registration_number' => 'required|string|max:255',
            'motorcycle_make' => 'required|string|max:255',
            'motorcycle_model' => 'required|string|max:255',
            'motorcycle_year' => 'required|integer|min:1990|max:' . date('Y'),
            'motorcycle_color' => 'required|string|max:255',
            'motorcycle_engine_number' => 'required|string|max:255',
            'motorcycle_chassis_number' => 'required|string|max:255',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:20',
            'emergency_contact_relationship' => 'required|string|max:255',
        ]);
        
        // Update rider information
        $rider->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'national_id' => $validated['national_id'],
            'date_of_birth' => $validated['date_of_birth'],
            'phone_number' => $validated['phone_number'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'stage_id' => $validated['stage_id'],
            'license_number' => $validated['license_number'],
            'license_class' => $validated['license_class'],
            'license_issue_date' => $validated['license_issue_date'],
            'license_expiry_date' => $validated['license_expiry_date'],
            'emergency_contact_name' => $validated['emergency_contact_name'],
            'emergency_contact_phone' => $validated['emergency_contact_phone'],
            'emergency_contact_relationship' => $validated['emergency_contact_relationship'],
        ]);
        
        // Update or create motorcycle information
        $rider->motorcycle()->updateOrCreate(
            ['rider_id' => $rider->id],
            [
                'registration_number' => $validated['motorcycle_registration_number'],
                'make' => $validated['motorcycle_make'],
                'model' => $validated['motorcycle_model'],
                'year' => $validated['motorcycle_year'],
                'color' => $validated['motorcycle_color'],
                'engine_number' => $validated['motorcycle_engine_number'],
                'chassis_number' => $validated['motorcycle_chassis_number'],
            ]
        );
        
        return redirect()->route('self-register')->with('success', 'Your registration has been updated successfully!');
    }
    
    public function checkRegistration(Request $request)
    {
        $request->validate([
            'check_type' => 'required|in:phone,national_id',
            'check_value' => 'required|string'
        ]);
        
        $rider = null;
        if ($request->check_type === 'phone') {
            $rider = Rider::where('phone_number', $request->check_value)->first();
        } else {
            $rider = Rider::where('national_id', $request->check_value)->first();
        }
        
        if ($rider) {
            $request->session()->put('check_registration', [
                'phone' => $rider->phone_number,
                'national_id' => $rider->national_id
            ]);
        }
        
        return redirect()->route('self-register');
    }
}
