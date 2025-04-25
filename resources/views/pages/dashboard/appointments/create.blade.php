@extends('layouts.dashboard_layout')

@section('title', 'Create Appointment')
@section('description', 'Schedule a new appointment')
@section('keywords', 'appointment, create, schedule')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Create Appointment</h1>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Appointment Details</h5>
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
                            <form action="{{ route('appointments.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="doctor_id" class="form-label">Doctor</label>
                                    <select name="doctor_id" id="doctor_id" class="form-control" required>
                                        <option value="">Select Doctor</option>
                                        @foreach($doctors as $doctor)
                                            <option value="{{ $doctor->id }}">{{ $doctor->user->first_name }} {{ $doctor->user->last_name }} ({{ $doctor->specialization->name }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="appointment_time" class="form-label">Appointment Time</label>
                                    <input type="datetime-local" name="appointment_time" id="appointment_time" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="notes" class="form-label">Notes</label>
                                    <textarea name="notes" id="notes" class="form-control"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Create Appointment</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(today.getDate() + 1);
            const year = tomorrow.getFullYear();
            const month = String(tomorrow.getMonth() + 1).padStart(2, '0'); // Months are zero-based
            const day = String(tomorrow.getDate()).padStart(2, '0');
            const hours = String(tomorrow.getHours()).padStart(2, '0');
            const minutes = String(tomorrow.getMinutes()).padStart(2, '0');

            const minDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;
            $('#appointment_time').attr('min', minDateTime);
        });
    </script>
@endsection
