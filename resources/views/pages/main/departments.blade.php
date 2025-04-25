@extends('layouts.main_layout')

@section('title') Departments @endsection
@section('description') Discover convenience and care at MediLab, your trusted online pharmacy. We offer a wide range of prescription medications, healthcare products, and personalized services. Experience hassle-free prescription refills, medication delivery, and expert health advice. Your well-being is our priority – welcome to a healthier,happier you with MediLab.@endsection
@section('keywords') Pharmacy, Online Pharmacy, Prescription Medications, Healthcare Products, Pharmacy Services, Medication Delivery, Health and Wellness, Pharmaceuticals, OTC Drugs, Prescription Refills, Medical Supplies, Health Advice, Drug Information @endsection

@section('content')
    <!-- ======= Departments Section ======= -->
    <section id="departments" class="departments">
        <div class="container">

            <div class="section-title">
                <h2>Departments</h2>
                <p>Medilab is the only private comprehensive healthcare system in the region. MediGroup continuously invests in development of the system, in equipment, premises and the education of the employees thus far, creating the premium level of service for patients. Please do not hesitate to contact us for all questions, suggestions and comments.</p>
            </div>

            <div class="row gy-4">
                <div class="col-lg-3">
                    <ul class="nav nav-tabs flex-column">
                        @foreach($departments as $d)
                            <li class="nav-item">
                                <a class="nav-link @if($loop->first) active show @endif" data-bs-toggle="tab" href="#tab-{{$loop->iteration}}">{{$d->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-9">
                    <div class="tab-content">
                        @foreach($departments as $d)
                        <div class="tab-pane @if($loop->first) active show @endif" id="tab-{{$loop->iteration}}">
                            <div class="row gy-4">
                                <div class="col-lg-8 details order-2 order-lg-1">
                                    <h3>{{$d->name}}</h3>
                                    <p>{{$d->description}}</p>
                                </div>
                                <div class="col-lg-4 text-center order-1 order-lg-2">
                                    <img src="{{asset('assets/img/'.$d->image)}}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End Departments Section -->
@endsection
