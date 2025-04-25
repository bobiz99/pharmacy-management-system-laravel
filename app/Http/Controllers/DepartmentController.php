<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class DepartmentController extends Controller
{
    function index() {
        $departments = Department::all();

        return view('pages.main.departments', ['departments'=>$departments]);
    }

    public function create() {
        return view('pages.dashboard.admin.departments.create');
    }

    public function store(Request $request) {

        $request->validate([
            'name' => 'required|string|max:40|min:4',
            'description' => 'nullable|string|min:10|max:1000',
            'image' => 'required|file|mimes:jpg,png|max:2048'
        ]);


        $data = $request->only('name', 'description');
        $imageName = time() . '.' . $request->image->extension();

        try {
            DB::beginTransaction();

            $request->image->move(public_path('assets/img'), $imageName);
            Department::create($data + ['image'=>$imageName]);

            DB::commit();

            Log::channel('activity')->info('Created department', [
                'user_id' => auth()->id(),
                'timestamp' => now(),
            ]);
            return redirect()->route('dashboard.departments')->with('success-msg', 'Department successfully created');

        } catch(Exception $e) {
            DB::rollBack();
            if (File::exists(public_path('/assets/img/' . $imageName))) {
                File::delete(public_path('/assets/img/' . $imageName));
            }

            return redirect()->back()->with('error-msg', $e->getMessage());
        }

    }

    public function destroy($id) {
        $department = Department::find($id);

        try {
            DB::beginTransaction();

            $department->delete();

            DB::commit();
            Log::channel('activity')->info('Removed department', [
                'user_id' => auth()->id(),
                'timestamp' => now(),
            ]);
            return response()->json(['success' => true, 'message' => 'Department successfully deleted']);

        } catch(Exception $e) {
            DB::rollBack();

            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function edit($id) {
        $department = Department::find($id);

        return view('pages.dashboard.admin.departments.edit', ['department' => $department]);
    }

    public function update(Request $request, $id) {
        $rules = [
            'name' => 'required|string|max:40|min:4',
            'description' => 'nullable|string|min:10|max:1000',
        ];

        if ($request->hasFile('image')) {
            $rules['image'] = 'file|mimes:jpg,png|max:2048';
        }

        $request->validate($rules);

        $department = Department::findOrFail($id);

        $data = $request->only('name', 'description');
        $newImageName = null;

        if ($request->hasFile('image')) {
            $newImageName = time() . '.' . $request->image->extension();
            $oldImagePath = public_path('assets/img/' . $department->image);

            try {
                DB::beginTransaction();

                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }

                $request->image->move(public_path('assets/img'), $newImageName);

                $department->update($data + ['image' => $newImageName]);

                DB::commit();
                Log::channel('activity')->info('Edited department', [
                    'user_id' => auth()->id(),
                    'timestamp' => now(),
                ]);
                return redirect()->route('dashboard.departments')->with('success-msg', 'Department successfully updated');

            } catch (Exception $e) {
                DB::rollBack();

                if ($newImageName && File::exists(public_path('/assets/img/' . $newImageName))) {
                    File::delete(public_path('/assets/img/' . $newImageName));
                }

                return redirect()->back()->with('error-msg', $e->getMessage());
            }
        } else {
            $department->update($data);
            Log::channel('activity')->info('Edited without changing image department', [
                'user_id' => auth()->id(),
                'timestamp' => now(),
            ]);
            return redirect()->route('dashboard.departments')->with('success-msg', 'Department updated without changing the image');
        }
    }
}
