@extends('layouts.dashboard_layout')

@section('title', 'Appointment Details')
@section('description', 'Details of the appointment')
@section('keywords', 'appointment, details, doctor, patient')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Appointment/Prescription Details</h1>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Appointment Information</h5>

                            @if (session('success-msg'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-1"></i>
                                    {{session('success-msg')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                    <i class="bi bi-exclamation-octagon me-1"></i>
                                    @foreach($errors->all() as $error)
                                        <p>{{$error}}</p>
                                    @endforeach
                                </div>
                            @endif
                            @if (session('error-msg'))
                                <div class="alert alert-danger mt-5">
                                    <p>{{session('error-msg')}}</p>
                                </div>
                            @endif

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Appointment ID</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="{{ $appointment->id }}" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Doctor</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="{{ $appointment->doctor->user->first_name }} {{ $appointment->doctor->user->last_name }}" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Patient</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="{{ $appointment->patient->user->first_name }} {{ $appointment->patient->user->last_name }}" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Appointment Time</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="{{ $appointment->appointment_time }}" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="{{ $appointment->status }}" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Notes</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" readonly>{{ $appointment->notes }}</textarea>
                                </div>
                            </div>

                            <h5 class="card-title">Prescriptions</h5>

                            <table class="table table-borderless">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Description</th>
                                    <th>Medications</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($appointment->prescriptions as $prescription)
                                    <tr>
                                        <td>{{ $prescription->id }}</td>
                                        <td>{{ $prescription->description }}</td>
                                        <td>
                                            <ul>
                                                @foreach ($prescription->medications as $medication)
                                                    <li>{{ $medication->name }} ({{ $medication->pivot->quantity }}) - {{ $medication->pivot->instructions }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            @if(Auth::user()->role === 2)
                            <a href="{{ route('prescriptions.create', $appointment->id) }}" class="btn btn-primary">Write Prescription</a>
                            @endif
                            <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Back to Appointments</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
