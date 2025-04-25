<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function index(Request $request) {

        $query = Doctor::with('user');

        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('specialization')) {
            $query->whereHas('specialization', function ($q) use ($request) {
                $q->where('id', $request->specialization);
            });
        }

        $doctors = $query->latest()->paginate(2)->withQueryString();

        $specializations = Specialization::all();

//        dd($doctors);

        return view('pages.main.doctors', compact('doctors', 'specializations'));
    }

    public function getAppointments() {

        if (Auth::user()->role->name == 'doctor') {

            $doctor = Doctor::where('user_id', Auth::user()->id)->first();
            $appointments = $doctor->appointments()->with('patient.user')->get();
            // $user = $doctor->user;

//            dd($appointments);

            return response()->json([
                'appointment' => $appointments
            ]);
        } else {
            return response()->json(['error' => 'Only doctors can access appointments']);
        }
    }
}
