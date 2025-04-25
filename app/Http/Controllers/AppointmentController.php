<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppointmentController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_id === 2) {
            $doctor = Doctor::where('user_id', Auth::user()->id)->first();
            if ($doctor) {
                $appointments = Appointment::where('doctor_id', $doctor->id)->with('patient.user')->get();
            } else {
                $appointments = collect();
            }

            return view('pages.dashboard.doctor.main', compact('appointments'));
        } elseif (Auth::user()->role_id === 3) {
            $appointments = Appointment::where('patient_id', Auth::user()->id)->with('doctor.user')->get();
            return view('pages.dashboard.patient.main', compact('appointments'));
        }
    }

    public function create()
    {
        $doctors = Doctor::with('user')->get();
        return view('pages.dashboard.appointments.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_time' => 'required|date',
        ]);

        try {

            DB::beginTransaction();

            Appointment::create([
                'patient_id' => Auth::user()->id,
                'doctor_id' => $request->doctor_id,
                'appointment_time' => $request->appointment_time,
                'status' => 'scheduled',
                'notes' => $request->notes,
            ]);

            DB::commit();

            Log::channel('activity')->info('Created appointment', [
                'user_id' => auth()->id(),
                'timestamp' => now(),
            ]);
            return redirect()->route('appointments.index')->with('success-msg', 'Appointment created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error-msg', $e->getMessage());
        }
    }

    public function show(Appointment $appointment)
    {
        $appointment->load('doctor.user', 'patient.user', 'prescriptions.medications');
        return view('pages.dashboard.appointments.show', compact('appointment'));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $request->validate([
            'status' => 'required|in:scheduled,completed,cancelled',
        ]);

        $appointment->update([
            'status' => $request->status,
        ]);

        Log::channel('activity')->info('Updated status of the appointment', [
            'user_id' => auth()->id(),
            'timestamp' => now(),
        ]);

        return redirect()->route('appointments.index')->with('success-msg', 'Appointment status updated successfully.');
    }
}
