<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {

        switch (Auth::user()->role_id) {
            case 1:

                $logFile = storage_path('logs/activity.log');
                $logs = [];

                if (file_exists($logFile)) {
                    $fileContent = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                    foreach ($fileContent as $line) {
                        if (preg_match('/\{.*\}/', $line, $matches)) {
                            $context = json_decode($matches[0], true);
                            $message = trim(str_replace($matches[0], '', $line));

                            if (preg_match('/^\[(.*?)\]/', $message, $timestampMatches)) {
                                $timestamp = $timestampMatches[1];
                                $infoMessage = trim(str_replace($timestampMatches[0], '', $message));


                                if (preg_match('/^[A-Za-z.]+:\s(.*)/', $infoMessage, $infoMatches)) {
                                    $infoMessage = $infoMatches[1];
                                }

                                $logs[] = array_merge($context, [
                                    'action' => $infoMessage,
                                    'timestamp' => $timestamp,
                                ]);
                            }
                        }
                    }
                }

                return view('pages.dashboard.admin.main', compact('logs'));
            case 2:
                return redirect()->route('appointments.index');
            case 3:
                return redirect()->route('appointments.index');
            default:
                return redirect()->route('home');
        }
    }

    public function profile() {

        if (Auth::user()->role_id === 2) {
            $currentUser = Doctor::where('user_id', Auth::user()->id)->with('user', 'specialization', 'department')->first();
        } elseif (Auth::user()->role_id === 3) {
            $currentUser = Patient::where('user_id', Auth::user()->id)->with('user')->first();
        } elseif (Auth::user()->role_id === 1) {
            $currentUser = User::where('id', Auth::user()->id)->first();

            //dd($currentUser);
        }

        //dd($currentUser);

        return view('pages.dashboard.profile', ['currentUser'=>$currentUser]);
    }

    public function author() {
        return view('pages.dashboard.author');
    }
}
