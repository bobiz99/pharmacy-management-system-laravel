<?php

namespace App\Http\Controllers;

use App\Models\Medication;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MedicationController extends Controller
{
    public function create() {
        return view('pages.dashboard.admin.medications.create');
    }

    public function store(Request $request) {

        $request->validate([
            'name' => 'required|string|max:255|min:5',
            'type' => 'required|string|max:255|min:5',
            'description' => 'nullable|string|min:10|max:1000'
        ]);

        try {
            DB::beginTransaction();
            Medication::create($request->all());
            DB::commit();

            Log::channel('activity')->info('Created medication', [
                'user_id' => auth()->id(),
                'timestamp' => now(),
            ]);
            return redirect()->route('dashboard.medications')->with('success-msg', 'Medication successfully created');

        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error-msg', $e->getMessage());
        }
    }

    public function destroy($id) {
        try {
            DB::beginTransaction();
            $medication = Medication::find($id);
            $medication->delete();
            DB::commit();

            Log::channel('activity')->info('Removed medication', [
                'user_id' => auth()->id(),
                'timestamp' => now(),
            ]);
            return response()->json(['success' => true, 'message' => 'Medication successfully deleted']);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function edit($id) {
        $medication = Medication::find($id);

        return view('pages.dashboard.admin.medications.edit', ['medication' => $medication]);
    }

    public function update(Request $request, $id) {

        $request->validate([
            'name' => 'required|string|max:255|min:5',
            'type' => 'required|string|max:255|min:5',
            'description' => 'nullable|string|min:10|max:1000'
        ]);

        try {
            DB::beginTransaction();
            $medication = Medication::find($id);

            $medication->name = $request->name;
            $medication->type = $request->type;
            $medication->description = $request->description;

            $medication->save();
            DB::commit();
            Log::channel('activity')->info('Updated medication', [
                'user_id' => auth()->id(),
                'timestamp' => now(),
            ]);
            return redirect()->route('dashboard.medications')->with('success-msg', 'Medication successfully updated');
        } catch(Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error-msg', $e->getMessage());
        }
    }
}
