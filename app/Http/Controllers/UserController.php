<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function createDoctor() {

        $departments = Department::all();
        $specializations = Specialization::all();

        return view('pages.dashboard.admin.users.createDoctor', ['departments'=>$departments, 'specializations'=>$specializations]);
    }

    public function storeDoctor(Request $request){
        $request->validate([
            'first_name' => 'required|string|min:2|max:50',
            'last_name' => 'required|string|min:2|max:50',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone_number' => 'required|string',
            'image' => 'file|mimes:jpg,png|max:2048',
            'department_id' => 'required|exists:departments,id',
            'specialization_id' => 'required|exists:specializations,id'
        ]);

        $imageName = time() . '.' . $request->image->extension();

        try {
            DB::beginTransaction();

            $request->image->move(public_path('assets/img/users'), $imageName);

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'image' => $imageName,
                'phone_number' => $request->phone_number,
                'role_id' => 2
            ]);

            Doctor::create([
                'user_id' => $user->id,
                'specialization_id' => $request->specialization_id,
                'department_id' => $request->department_id,
            ]);

            DB::commit();

            Log::channel('activity')->info('Created a new doctor', [
                'user_id' => auth()->id(),
                'timestamp' => now(),
            ]);
            return redirect()->route('dashboard.users')->with('success-msg', 'Doctor created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            if (File::exists(public_path('/assets/img/users' . $imageName))) {
                File::delete(public_path('/assets/img/users' . $imageName));
            }

            return redirect()->back()->with('error-msg', $e->getMessage());
        }
    }

    public function createPatient() {
        return view('pages.dashboard.admin.users.createPatient');
    }

    public function storePatient(Request $request){
        $request->validate([
            'first_name' => 'required|string|min:2|max:50',
            'last_name' => 'required|string|min:2|max:50',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone_number' => 'required|string',
            'image' => 'file|mimes:jpg,png|max:2048',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'required|date',
            'address' => 'required|string|max:255',
            'JMBG' => 'required|string|min:13|max:13|unique:patients'
        ]);

        $imageName = time() . '.' . $request->image->extension();

        try {
            DB::beginTransaction();

            $request->image->move(public_path('assets/img/users'), $imageName);

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'image' => $imageName,
                'phone_number' => $request->phone_number,
                'role_id' => 3
            ]);

            Patient::create([
                'user_id' => $user->id,
                'address' => $request->address,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'JMBG' => $request->JMBG
            ]);

            DB::commit();

            Log::channel('activity')->info('Created a new patient', [
                'user_id' => auth()->id(),
                'timestamp' => now(),
            ]);
            return redirect()->route('dashboard.users')->with('success-msg', 'Patient created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            if (File::exists(public_path('/assets/img/users' . $imageName))) {
                File::delete(public_path('/assets/img/users' . $imageName));
            }

            return redirect()->back()->with('error-msg', $e->getMessage());
        }
    }

    public function destroy($id) {
        $user = User::find($id);

        try {
            DB::beginTransaction();

            $user->delete();

            DB::commit();

            Log::channel('activity')->info('Removed a user', [
                'user_id' => auth()->id(),
                'timestamp' => now(),
            ]);
            return response()->json(['success' => true, 'message' => 'User successfully deleted']);

        } catch(\Exception $e) {
            DB::rollBack();

            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function edit($id) {
        $user = User::find($id);
        //dd($user);
        if ($user->role_id === 2) {
            $user = User::with(['doctor.department', 'doctor.specialization'])->find($id);
            $departments = Department::all();
            $specializations = Specialization::all();
            return view('pages.dashboard.admin.users.editDoctor', ['user' => $user, 'departments' => $departments, 'specializations' => $specializations]);
        } elseif ($user->role_id === 3) {
            $user = User::with('patient')->find($id);
            return view('pages.dashboard.admin.users.editPatient', ['user' => $user]);
        } else {
            return redirect()->back()->with('error-msg', 'User not found');
        }
    }

    public function updateDoctor(Request $request, $id) {
        $request->validate([
            'first_name' => 'required|string|min:2|max:50',
            'last_name' => 'required|string|min:2|max:50',
            'email' => 'required|string|email|max:50|unique:users,email,' . $id,
            'phone_number' => 'required|string',
            'image' => 'nullable|file|mimes:jpg,png|max:2048',
            'department_id' => 'required|integer|exists:departments,id',
            'specialization_id' => 'required|integer|exists:specializations,id',
            'password' => 'nullable|string|min:6|confirmed',
            'current_password' => 'nullable|required_with:password|string',
        ]);

        $user = User::findOrFail($id);

        if ($request->password && !Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error-msg', 'The current password is incorrect.');
        }

        $imageName = $user->image;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('assets/img/users'), $imageName);

            // Delete old image
            if (File::exists(public_path('assets/img/users/' . $user->image))) {
                File::delete(public_path('assets/img/users/' . $user->image));
            }
        }

        try {
            DB::beginTransaction();

            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'image' => $imageName
            ]);

            if ($request->password) {
                $user->update(['password' => Hash::make($request->password)]);
            }

            $user->doctor()->update([
                'department_id' => $request->department_id,
                'specialization_id' => $request->specialization_id
            ]);

            DB::commit();

            Log::channel('activity')->info('Updated doctor', [
                'user_id' => auth()->id(),
                'timestamp' => now(),
            ]);
            return redirect()->route('dashboard.users')->with('success-msg', 'Doctor updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error-msg', $e->getMessage());
        }
    }

    public function updatePatient(Request $request, $id) {
        $request->validate([
            'first_name' => 'required|string|min:2|max:50',
            'last_name' => 'required|string|min:2|max:50',
            'email' => 'required|string|email|max:50|unique:users,email,' . $id,
            'phone_number' => 'required|string',
            'image' => 'nullable|file|mimes:jpg,png|max:2048',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'required|date',
            'address' => 'required|string|max:255',
            'JMBG' => 'required|string|min:13|max:13|unique:patients,JMBG,' . $id . ',user_id',
            'password' => 'nullable|string|min:6|confirmed',
            'current_password' => 'nullable|required_with:password|string',
        ]);

        $user = User::findOrFail($id);

        if ($request->password && !Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error-msg', 'The current password is incorrect.');
        }

        $imageName = $user->image;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('assets/img/users'), $imageName);

            // Delete old image
            if (File::exists(public_path('assets/img/users/' . $user->image))) {
                File::delete(public_path('assets/img/users/' . $user->image));
            }
        }

        try {
            DB::beginTransaction();

            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'image' => $imageName
            ]);

            if ($request->password) {
                $user->update(['password' => Hash::make($request->password)]);
            }

            $user->patient()->update([
                'address' => $request->address,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'JMBG' => $request->JMBG
            ]);

            DB::commit();

            Log::channel('activity')->info('Updated patient', [
                'user_id' => auth()->id(),
                'timestamp' => now(),
            ]);
            return redirect()->route('dashboard.users')->with('success-msg', 'Patient updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error-msg', $e->getMessage());
        }
    }
}
