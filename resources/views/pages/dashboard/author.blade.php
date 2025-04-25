@extends('layouts.dashboard_layout')

@section('title') Profile @endsection
@section('description') Review your information @endsection
@section('keywords') dashboard, review, information @endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Auhtor</h1>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-12">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <img src="{{asset('assets/img/mojaFotka.jpg')}}" alt="Profile" class="">
                            <h2>Slobodan Zafirovski</h2>
                            <h3>52/18</h3>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
