<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prescription;
use App\Models\Appointment;
use App\Models\Medication;
use Illuminate\Support\Facades\Log;

class PrescriptionController extends Controller
{
    public function create(Appointment $appointment)
    {
        $medications = Medication::all();
        return view('pages.dashboard.prescriptions.create', compact('appointment', 'medications'));
    }

    public function store(Request $request, Appointment $appointment)
    {
        $request->validate([
            'description' => 'required|string',
            'medications' => 'required|array',
            'medications.*.id' => 'required|exists:medications,id',
            'medications.*.quantity' => 'required|integer',
            'medications.*.instructions' => 'nullable|string',
        ]);

        $prescription = Prescription::create([
            'appointment_id' => $appointment->id,
            'description' => $request->description,
        ]);

        foreach ($request->medications as $medication) {
            if (isset($medication['id'])) {
                $prescription->medications()->attach($medication['id'], [
                    'quantity' => $medication['quantity'],
                    'instructions' => $medication['instructions'] ?? null,
                ]);
            }
        }

        Log::channel('activity')->info('Created a prescription', [
            'user_id' => auth()->id(),
            'timestamp' => now(),
        ]);


        return redirect()->route('appointments.show', $appointment->id)->with('success-msg', 'Prescription created successfully.');
    }
}
