@extends('layouts.dashboard_layout')

@section('title') Dashboard @endsection
@section('description') Review your information @endsection
@section('keywords') dashboard, review, information @endsection

@section('content')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Welcome {{ Auth::user()->first_name }}<br>Doctor Dashboard</h1>
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
                                    {{ session('success-msg') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('error-msg'))
                                <div class="alert alert-danger mt-5">
                                    <p>{{ session('error-msg') }}</p>
                                </div>
                            @endif

                            <table class="table table-borderless datatable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Patient</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($appointments as $appointment)
                                    <tr>
                                        <td>{{ $appointment->id }}</td>
                                        <td>{{ $appointment->patient->user->first_name }} {{ $appointment->patient->user->last_name }}</td>
                                        <td>{{ $appointment->appointment_time }}</td>
                                        <td>
                                            <span class="badge
                                                @if ($appointment->status == 'completed') bg-success @endif
                                                @if ($appointment->status == 'cancelled') bg-danger @endif
                                                @if ($appointment->status == 'scheduled') bg-warning @endif">
                                                {{ $appointment->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-info">View</a>
                                            <a href="{{ route('prescriptions.create', $appointment->id) }}" class="btn btn-primary">Write Prescription</a>
                                            <form action="{{ route('appointments.updateStatus', $appointment->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" onchange="this.form.submit()">
                                                    <option value="scheduled" @if($appointment->status == 'scheduled') selected @endif>Scheduled</option>
                                                    <option value="completed" @if($appointment->status == 'completed') selected @endif>Completed</option>
                                                    <option value="cancelled" @if($appointment->status == 'cancelled') selected @endif>Cancelled</option>
                                                </select>
                                            </form>
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
