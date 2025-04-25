<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Medication;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getAllUser(Request $request) {
        $query = User::with('role');

        if ($request->has('role_id') && $request->role_id != '') {
            $query->where('role_id', $request->role_id);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->paginate(8);

        if ($request->ajax()) {
            return response()->json([
                'tableHtml' => view('pages.dashboard.admin.partials.users', compact('users'))->render(),
            ]);
        }

        return view('pages.dashboard.admin.users', compact('users'));
    }

    public function getAllDepartments(Request $request) {
        $query = Department::query();

        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $departments = $query->paginate(5);

        if ($request->ajax()) {
            return response()->json([
                'tableHtml' => view('pages.dashboard.admin.partials.departments', compact('departments'))->render(),
            ]);
        }

        return view('pages.dashboard.admin.departments', compact('departments'));
    }

    public function getAllSpecializations(Request $request) {
        $query = Specialization::query();

        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $specializations = $query->paginate(5);

        if ($request->ajax()) {
            return response()->json([
                'tableHtml' => view('pages.dashboard.admin.partials.specializations', compact('specializations'))->render(),
            ]);
        }

        return view('pages.dashboard.admin.specializations', compact('specializations'));
    }

    public function getAllMedications(Request $request) {
        $query = Medication::query();

        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $medications = $query->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'tableHtml' => view('pages.dashboard.admin.partials.medications', compact('medications'))->render(),
            ]);
        }

        return view('pages.dashboard.admin.medications', compact('medications'));
    }
}
