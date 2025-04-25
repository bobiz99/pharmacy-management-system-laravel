@extends('layouts.dashboard_layout')

@section('title') Medication @endsection
@section('description') Create Medication @endsection
@section('keywords') dashboard, review, information, medication @endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Create Medication</h1>
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
                            <form action="{{route('dashboard.medication.store')}}" method="POST" class="row g-3 mt-3">
                                @csrf
                                <div class="col-12">
                                    <label for="name" class="form-label">Name of Medication</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">

                                    <label for="type" class="form-label">Type of Medication</label>
                                    <input type="text" class="form-control" name="type" id="type" value="{{old('type')}}">

                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" class="form-control" name="description" id="description" value="{{old('description')}}">
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
