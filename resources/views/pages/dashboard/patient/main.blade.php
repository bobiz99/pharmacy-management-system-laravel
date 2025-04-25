@extends('layouts.dashboard_layout')

@section('title') Dashboard @endsection
@section('description') Review your information @endsection
@section('keywords') dashboard, review, information @endsection

@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Welcome {{Auth::user()->first_name}}<br>Patient Dashboard</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Your Appointments</h5>
                            @if (session('success-msg'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-1"></i>
                                    {{session('success-msg')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('error-msg'))
                                <div class="alert alert-danger mt-5">
                                    <p>{{session('error-msg')}}</p>
                                </div>
                            @endif
                            <a href="{{ route('appointments.create') }}" class="btn btn-primary">Create Appointment</a>
                            <table class="table table-borderless datatable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Doctor</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($appointments as $appointment)
                                    <tr>
                                        <td>{{ $appointment->id }}</td>
                                        <td>{{ $appointment->doctor->user->first_name }} {{ $appointment->doctor->user->last_name }}</td>
                                        <td>{{ $appointment->appointment_time }}</td>
                                        <td><span class="badge
                                         @if ($appointment->status == 'completed') bg-success @endif
                                         @if ($appointment->status == 'cancelled') bg-danger @endif
                                         @if ($appointment->status == 'scheduled') bg-warning @endif">
                                                {{ $appointment->status }}</span></td>
                                        <td>
                                            <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-info">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
