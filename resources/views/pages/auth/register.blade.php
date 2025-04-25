@extends('layouts.auth_layout')

@section('content')
    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="{{route('home')}}" class="logo d-flex align-items-center w-auto">
                                    <img src="{{asset('assets/img/logo.png')}}" alt="">
                                    <span class="d-none d-lg-block">Medilab</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                        <p class="text-center small">Enter your personal details to create account</p>
                                    </div>

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>

                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach

                                            </ul>
                                        </div>
                                    @endif

                                    @if(session('error-msg'))
                                        <div class="alert alert-danger">
                                            <p>{{session('error-msg')}}</p>
                                        </div>
                                    @endif

                                    <form action="{{route('do-register')}}" method="POST" class="row g-3">
                                        @csrf
                                        <div class="col-12">
                                            <label for="firstName" class="form-label">First Name</label>
                                            <input type="text" name="first_name" class="form-control" id="firstName" required>
                                        </div>

                                        <div class="col-12">
                                            <label for="lastName" class="form-label">Last Name</label>
                                            <input type="text" name="last_name" class="form-control" id="lastName" required>
                                        </div>

                                        <div class="col-12">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" id="email" required>
                                        </div>

                                        <div class="col-12">
                                            <label for="gender" class="form-label">Gender</label>
                                            <select name="gender" class="form-control" id="gender" required>
                                                <option value="">Select Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label for="dateOfBirth" class="form-label">Date of Birth</label>
                                            <input type="date" name="date_of_birth" class="form-control" id="dateOfBirth" required>
                                        </div>

                                        <div class="col-12">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" name="address" class="form-control" id="address" required>
                                        </div>

                                        <div class="col-12">
                                            <label for="phoneNumber" class="form-label">Phone Number</label>
                                            <input type="text" name="phone_number" class="form-control" id="phoneNumber" required>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourJMBG" class="form-label">JMBG</label>
                                            <input type="text" name="JMBG" class="form-control" id="yourJMBG" required>
                                        </div>

                                        <div class="col-12">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="password" required>
                                        </div>

                                        <div class="col-12">
                                            <label for="passwordConfirmation" class="form-label">Confirm Password</label>
                                            <input type="password" name="password_confirmation" class="form-control" id="passwordConfirmation" required>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Create Account</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Already have an account? <a href="{{route('login')}}">Login</a></p>
                                        </div>
                                    </form>

                                </div>
                            </div>

                            <div class="credits">
                                <!-- All the links in the footer should remain intact. -->
                                <!-- You can delete the links only if you purchased the pro version. -->
                                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <script>
        const today = new Date();
        const maxDay = String(today.getDate()).padStart(2, '0');
        const maxMonth = String(today.getMonth() + 1).padStart(2, '0');
        const maxYear = today.getFullYear();

        const minYear = 1915;
        const minMonth = "01";
        const minDay = "01";

        const maxDate = maxYear + '-' + maxMonth + '-' + maxDay;
        const minDate = minYear + '-' + minMonth + '-' + minDay;

        document.getElementById("dateOfBirth").setAttribute("max", maxDate);
        document.getElementById("dateOfBirth").setAttribute("min", minDate);
    </script>
@endsection
