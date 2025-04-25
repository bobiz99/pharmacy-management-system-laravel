<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PrescriptionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/departments', [DepartmentController::class, 'index'])->name('departments');
Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
    Route::get('/dashboard/appointments', [DoctorController::class, 'getAppointments'])->name('get-appointments');
    Route::get('/author', [DashboardController::class, 'author'])->name('dashboard.author');

    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments/store', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
    Route::get('/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
    Route::post('/appointments/{appointment}/update', [AppointmentController::class, 'update'])->name('appointments.update');
    Route::put('/appointments/{appointment}/status', [AppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');


    // Prescription Routes
    Route::get('/appointments/{appointment}/prescriptions/create', [PrescriptionController::class, 'create'])->name('prescriptions.create');
    Route::post('/appointments/{appointment}/prescriptions', [PrescriptionController::class, 'store'])->name('prescriptions.store');

});

Route::middleware(['auth', 'isadmin'])->group(function() {
    Route::get('/dashboard/users', [AdminController::class, 'getAllUser'])->name('dashboard.users');
    Route::get('/dashboard/departments', [AdminController::class, 'getAllDepartments'])->name('dashboard.departments');
    Route::get('/dashboard/specializations', [AdminController::class, 'getAllSpecializations'])->name('dashboard.specializations');
    Route::get('/dashboard/medications', [AdminController::class, 'getAllMedications'])->name('dashboard.medications');

    //Users
    //Doctor Store
    Route::get('/dashboard/users/create-doctor', [UserController::class, 'createDoctor'])->name('dashboard.user.create.doctor');
    Route::post('/dashboard/user/store-doctor', [UserController::class, 'storeDoctor'])->name('dashboard.user.store.doctor');
    //Patient Store
    Route::get('/dashboard/users/create-patient', [UserController::class, 'createPatient'])->name('dashboard.user.create.patient');
    Route::post('/dashboard/user/store-patient', [UserController::class, 'storePatient'])->name('dashboard.user.store.patient');

    //User delete
    Route::delete('/dashboard/users/{id}', [UserController::class, 'destroy'])->name('dashboard.user.delete');
    Route::match(['post', 'get'],'/dashboard/users/{id}', [UserController::class, 'edit'])->name('dashboard.user.edit');
    Route::put('/dashboard/user/doctor/{id}', [UserController::class, 'updateDoctor'])->name('dashboard.user.update.doctor');
    Route::put('/dashboard/user/patient/{id}', [UserController::class, 'updatePatient'])->name('dashboard.user.update.patient');


    //Specializations
    Route::get('/dashboard/specializations/create', [SpecializationController::class, 'create'])->name('dashboard.specialization.create');
    Route::post('/dashboard/specializations/store', [SpecializationController::class, 'store'])->name('dashboard.specialization.store');
    Route::delete('/dashboard/specializations/{id}', [SpecializationController::class, 'destroy'])->name('dashboard.specialization.delete');
    Route::match(['post', 'get'],'/dashboard/specializations/{id}', [SpecializationController::class, 'edit'])->name('dashboard.specialization.edit');
    Route::put('/dashboard/specialization/{id}', [SpecializationController::class, 'update'])->name('dashboard.specialization.update');

    //Medications
    Route::get('/dashboard/medications/create', [MedicationController::class, 'create'])->name('dashboard.medication.create');
    Route::post('/dashboard/medications/store', [MedicationController::class, 'store'])->name('dashboard.medication.store');
    Route::delete('/dashboard/medications/{id}', [MedicationController::class, 'destroy'])->name('dashboard.medication.delete');
    Route::match(['post', 'get'],'/dashboard/medications/{id}', [MedicationController::class, 'edit'])->name('dashboard.medication.edit');
    Route::put('/dashboard/medication/{id}', [MedicationController::class, 'update'])->name('dashboard.medication.update');

    //Departments
    Route::get('/dashboard/departments/create', [DepartmentController::class, 'create'])->name('dashboard.department.create');
    Route::post('/dashboard/departments/store', [DepartmentController::class, 'store'])->name('dashboard.department.store');
    Route::delete('/dashboard/departments/{id}', [DepartmentController::class, 'destroy'])->name('dashboard.department.delete');
    Route::match(['post', 'get'],'/dashboard/departments/{id}', [DepartmentController::class, 'edit'])->name('dashboard.department.edit');
    Route::put('/dashboard/department/{id}', [DepartmentController::class, 'update'])->name('dashboard.department.update');
});

Route::middleware(['notauth'])->group(function (){
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'doLogin'])->name('do-login');
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'doRegister'])->name('do-register');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
