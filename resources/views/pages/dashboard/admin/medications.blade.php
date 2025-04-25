@extends('layouts.dashboard_layout')

@section('title') Dashboard - Medications @endsection
@section('description') Review your information about medications @endsection
@section('keywords') dashboard, review, information @endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Medications</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">

                <!-- Recent Sales -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">

                        <div class="card-body">
                            <h5 class="card-title">List of All Medications</h5>
                            @if (session('success-msg'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-1"></i>
                                    {{session('success-msg')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <div id="messageBox"></div>

                            @if (session('error-msg'))
                                <div class="alert alert-danger mt-5">
                                    <p>{{session('error-msg')}}</p>
                                </div>
                            @endif

                            <a href="{{route('dashboard.medication.create')}}" type="button" class="btn btn-dark mt-2 mb-3"><i class="bi bi-plus-circle me-1"></i> Add New Medication</a>

                            <div class="card-header">
                                <form id="searchForm">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search..." name="search" id="search">
                                    </div>
                                </form>
                            </div>

                            <div id="medicationsContent"></div>

                        </div>

                    </div>
                </div><!-- End Recent Sales -->

            </div>
        </section>

    </main><!-- End #main -->
@endsection

@section('scripts')
    <script src="{{ asset('assets2/js/medications.js') }}"></script>
@endsection
