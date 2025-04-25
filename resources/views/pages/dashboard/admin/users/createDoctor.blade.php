@extends('layouts.dashboard_layout')

@section('title') Create Doctor @endsection
@section('description') Create New Doctor @endsection
@section('keywords') dashboard, review, information, user @endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Create New Doctor</h1>
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
                            <form action="{{route('dashboard.user.store.doctor')}}" method="POST" enctype="multipart/form-data" class="row g-3 mt-3">
                                @csrf
                                <div class="col-12">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="first_name" id="firstName" value="{{old('first_name')}}" required>

                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" id="lastName" value="{{old('last_name')}}" required>

                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" required>

                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" required>

                                    <label for="passwordConfirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" id="passwordConfirmation" required>

                                    <label for="department" class="form-label">Department</label>
                                    <select class="form-select form-control" name="department_id" id="department" required>
                                        <option value="">Select Department</option>
                                        @foreach($departments as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>

                                    <label for="specialization" class="form-label">Specialization</label>
                                    <select class="form-select form-control" name="specialization_id" id="specialization" required>
                                        <option value="">Select Specialization</option>
                                        @foreach($specializations as $s)
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                    </select>

                                    <label for="phoneNumber" class="form-label">Phone Number</label>
                                    <input type="text" name="phone_number" class="form-control" id="phoneNumber" value="{{old('phone_number')}}" required>

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
