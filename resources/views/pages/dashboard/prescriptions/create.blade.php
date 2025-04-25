@extends('layouts.dashboard_layout')

@section('title') Write Prescription @endsection
@section('description') Write a prescription for an appointment @endsection
@section('keywords') prescription, write, appointment @endsection

@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Write Prescription</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Prescription Details for Appointment #{{ $appointment->id }}</h5>

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

                            <form action="{{ route('prescriptions.store', $appointment->id) }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="description" class="form-control" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="medications" class="form-label">Medications</label>
                                    <div id="medications">
                                        <div class="medication-group mb-3">
                                            <select name="medications[0][id]" class="form-control" required>
                                                <option value="" disabled selected>Select Medication</option>
                                                @foreach($medications as $medication)
                                                    <option value="{{ $medication->id }}">{{ $medication->name }}</option>
                                                @endforeach
                                            </select>
                                            <input type="number" name="medications[0][quantity]" placeholder="Quantity" class="form-control mt-2" required>
                                            <input type="text" name="medications[0][instructions]" placeholder="Instructions" class="form-control mt-2">
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary mt-2" id="add-medication">Add Medication</button>
                                </div>

                                <button type="submit" class="btn btn-primary">Create Prescription</button>
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
        document.addEventListener('DOMContentLoaded', function () {
            let medicationIndex = 1;

            document.getElementById('add-medication').addEventListener('click', function () {
                const medicationsDiv = document.getElementById('medications');
                const newMedicationGroup = document.createElement('div');
                newMedicationGroup.classList.add('medication-group', 'mb-3');

                newMedicationGroup.innerHTML = `
                <select name="medications[${medicationIndex}][id]" class="form-control" required>
                    <option value="" disabled selected>Select Medication</option>
                    @foreach($medications as $medication)
                <option value="{{ $medication->id }}">{{ $medication->name }}</option>
                    @endforeach
                </select>
                <input type="number" name="medications[${medicationIndex}][quantity]" placeholder="Quantity" class="form-control mt-2" required>
                <input type="text" name="medications[${medicationIndex}][instructions]" placeholder="Instructions" class="form-control mt-2">
            `;

                medicationsDiv.appendChild(newMedicationGroup);
                medicationIndex++;
            });
        });
    </script>
@endsection
