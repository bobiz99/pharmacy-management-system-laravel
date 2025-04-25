@extends('layouts.dashboard_layout')

@section('title') Profile @endsection
@section('description') Review your information @endsection
@section('keywords') dashboard, review, information @endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Profile</h1>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            @if(Auth::user()->role_id === 1)
                            <img src="{{asset('assets/img/users/'. $currentUser->image)}}" alt="Profile" class="rounded-circle">
                            @else
                                <img src="{{asset('assets/img/users/'. $currentUser->user->image)}}" alt="Profile" class="rounded-circle">
                            @endif
                            @if(Auth::user()->role_id === 1)
                                <h2>{{$currentUser->first_name . ' ' . $currentUser->last_name}}</h2>
                            @else
                                <h2>{{$currentUser->user->first_name . ' ' . $currentUser->user->last_name}}</h2>
                            @endif
                            <h3>@if(Auth::user()->role_id === 2) Doctor @elseif(Auth::user()->role_id === 2) Patient @elseif(Auth::user()->role_id === 1) Admin @endif</h3>
                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                        @if(Auth::user()->role_id === 1)
                                            <div class="col-lg-9 col-md-8">{{$currentUser->first_name . ' ' . $currentUser->last_name}}</div>
                                        @else
                                            <div class="col-lg-9 col-md-8">{{$currentUser->user->first_name . ' ' . $currentUser->user->last_name}}</div>
                                        @endif
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        @if(Auth::user()->role_id === 1)
                                            <div class="col-lg-9 col-md-8">{{$currentUser->email}}</div>
                                        @else
                                            <div class="col-lg-9 col-md-8">{{$currentUser->user->email}}</div>
                                        @endif
                                    </div>

                                    @if(Auth::user()->role_id === 2)
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Specialization</div>
                                            <div class="col-lg-9 col-md-8">{{$currentUser->specialization->name}}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Department</div>
                                            <div class="col-lg-9 col-md-8">{{$currentUser->department->name}}</div>
                                        </div>
                                    @endif

                                    @if(Auth::user()->role_id === 3)
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">JMBG</div>
                                            <div class="col-lg-9 col-md-8">{{$currentUser->JMBG}}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Date of birth</div>
                                            <div class="col-lg-9 col-md-8">{{$currentUser->date_of_birth}}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Gender</div>
                                            <div class="col-lg-9 col-md-8">{{$currentUser->gender}}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Address</div>
                                            <div class="col-lg-9 col-md-8">{{$currentUser->address}}</div>
                                        </div>

                                    @endif

                                    @if(Auth::user()->role_id === 1)
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Phone</div>
                                            <div class="col-lg-9 col-md-8">{{$currentUser->phone_number}}</div>
                                        </div>
                                    @else
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Phone</div>
                                            <div class="col-lg-9 col-md-8">{{$currentUser->user->phone_number}}</div>
                                        </div>
                                    @endif

                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
