@extends('layouts.dashboard_layout')

@section('title') Department @endsection
@section('description') Edit Department @endsection
@section('keywords') dashboard, review, information, department @endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Update {{$department->name}} Department</h1>
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
                            <form action="{{route('dashboard.department.update', ['id' => $department->id])}}" method="POST" enctype="multipart/form-data" class="row g-3 mt-3">
                                @csrf
                                @method('put')
                                <div class="col-12">
                                    <label for="name" class="form-label">Name of Department</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{$department->name}}">

                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" class="form-control" name="description" id="description" value="{{$department->description}}">

                                    <label for="image" class="form-label">Image</label>
                                    <div class="col-4 col-xs-12 mb-3">
                                        <img src="{{asset('assets/img/'.$department->image)}}" alt="" class="img-fluid card-img-bottom">
                                    </div>

                                    <input class="form-control" type="file" id="image" name="image">
                                </div>
                                <div class="text-left">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form><!-- Vertical Form -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
