@extends('layouts.dashboard_layout')

@section('title') Create Patient @endsection
@section('description') Create New Patient @endsection
@section('keywords') dashboard, review, information, user @endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Create New Patient</h1>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
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

                            <!-- Vertical Form -->
                            <form action="{{route('dashboard.user.store.patient')}}" method="POST" enctype="multipart/form-data" class="row g-3 mt-3">
                                @csrf
                                <div class="col-12">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="first_name" id="firstName" value="{{old('first_name')}}">

                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" id="lastName" value="{{old('last_name')}}">

                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}">

                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" required>

                                    <label for="passwordConfirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" id="passwordConfirmation" required>

                                    <label for="dateOfBirth" class="form-label">Date of Birth</label>
                                    <input type="date" name="date_of_birth" class="form-control" id="dateOfBirth" required>

                                    <label for="yourJMBG" class="form-label">JMBG</label>
                                    <input type="text" name="JMBG" class="form-control" id="yourJMBG" required>

                                    <label for="gender" class="form-label">Gender</label>
                                    <select name="gender" class="form-control" id="gender" required>
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>

                                    <label for="phoneNumber" class="form-label">Phone Number</label>
                                    <input type="text" name="phone_number" class="form-control" id="phoneNumber" value="{{old('phone_number')}}" required>

                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control" id="address" required>

                                    <label for="image" class="form-label">Image</label>
                                    <input class="form-control" type="file" id="image" name="image">

                                </div>
                                <div class="text-left">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </form><!-- Vertical Form -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
