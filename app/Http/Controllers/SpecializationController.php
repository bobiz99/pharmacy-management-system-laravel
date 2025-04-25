<?php

namespace App\Http\Controllers;

use App\Models\Specialization;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SpecializationController extends Controller
{
    public function create() {
        return view('pages.dashboard.admin.specializations.create');
    }

    public function store(Request $request) {

        $request->validate([
            'name' => 'required|string|max:255|min:5'
        ]);

        try {
            DB::beginTransaction();
            Specialization::create($request->all());
            DB::commit();
            Log::channel('activity')->info('Created a specialization', [
                'user_id' => auth()->id(),
                'timestamp' => now(),
            ]);
            return redirect()->route('dashboard.specializations')->with('success-msg', 'Specialization successfully created');

        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error-msg', $e->getMessage());
        }
    }

    public function destroy($id) {
        try {
            DB::beginTransaction();
            $specialization = Specialization::find($id);
            $specialization->delete();
            DB::commit();
            Log::channel('activity')->info('Removed the specialization', [
                'user_id' => auth()->id(),
                'timestamp' => now(),
            ]);
            return response()->json(['success' => true, 'message' => 'Specialization successfully deleted']);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function edit($id) {
        $specialization = Specialization::find($id);

        //dd($specialization);

        return view('pages.dashboard.admin.specializations.edit', ['specialization' => $specialization]);
    }

    public function update(Request $request, $id) {

        $request->validate([
            'name' => 'required|string|max:255|min:5'
        ]);

        try {
            DB::beginTransaction();
            $specialization = Specialization::find($id);

            $specialization->name = $request->name;

            $specialization->save();
            DB::commit();
            Log::channel('activity')->info('Edited specialization', [
                'user_id' => auth()->id(),
                'timestamp' => now(),
            ]);
            return redirect()->route('dashboard.specializations')->with('success-msg', 'Specialization successfully updated');
        } catch(Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error-msg', $e->getMessage());
        }
    }
}
