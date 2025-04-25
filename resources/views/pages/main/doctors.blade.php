@extends('layouts.main_layout')

@section('title') Doctors @endsection
@section('description') Discover convenience and care at MediLab, your trusted online pharmacy. We offer a wide range of prescription medications, healthcare products, and personalized services. Experience hassle-free prescription refills, medication delivery, and expert health advice. Your well-being is our priority – welcome to a healthier,happier you with MediLab.@endsection
@section('keywords') Pharmacy, Online Pharmacy, Prescription Medications, Healthcare Products, Pharmacy Services, Medication Delivery, Health and Wellness, Pharmaceuticals, OTC Drugs, Prescription Refills, Medical Supplies, Health Advice, Drug Information @endsection


@section('content')
    <!-- ======= Doctors Section ======= -->
    <section id="doctors" class="doctors">
        <div class="container">

            <div class="section-title">
                <h2>Doctors</h2>
                <p>The Medilab healthcare system is proud of the doctors and professors who could work anywhere in the world, but they are proud to work with us.</p>
            </div>

            <!-- Search and Filter Form -->
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('doctors') }}" method="GET" class="d-flex mb-4">
                        <input type="text" name="search" class="form-control me-2" placeholder="Search for doctors..." value="{{ request('search') }}">
                        <select class="form-select me-2" name="specialization">
                            <option value="">All Specializations</option>
                            @foreach($specializations as $specialization)
                                <option value="{{ $specialization->id }}" {{ request('specialization') == $specialization->id ? 'selected' : '' }}>
                                    {{ $specialization->name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>
            </div>

            <div class="row">

                @if($doctors->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        No matching doctors found.
                    </div>
                @else
                    @foreach($doctors as $d)
                        <div class="col-lg-6 mt-4">
                            <div class="member d-flex align-items-start">
                                <div class="pic"><img src="{{ asset('assets/img/users/' . $d->user->image) }}" class="img-fluid" alt=""></div>
                                <div class="member-info">
                                    <h4>{{ $d->user->first_name }} {{ $d->user->last_name }}</h4>
                                    <span>{{ $d->specialization->name }}</span>
                                    <!-- Add any additional info you want to show for each doctor -->
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-4 w-100">
                        {{ $doctors->links() }}
                    </div>
                @endif

            </div>

        </div>
    </section><!-- End Doctors Section -->
@endsection
