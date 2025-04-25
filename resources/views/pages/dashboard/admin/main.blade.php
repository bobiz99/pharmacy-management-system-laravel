@extends('layouts.dashboard_layout')

@section('title') Dashboard @endsection
@section('description') Review your information @endsection
@section('keywords') dashboard, review, information @endsection

@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Welcome {{ Auth::user()->first_name }}<br>Admin Dashboard</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">

                <!-- Recent Activity -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Recent Users Activity</h5>
                            <table class="table table-borderless datatable">
                                <thead>
                                <tr>
                                    <th scope="col">User ID</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($logs as $index => $log)
                                    <tr>
                                        <td>{{ $log['user_id'] ?? 'N/A' }}</td>
                                        <td>{{ $log['action'] ?? 'N/A' }}</td>
                                        <td>{{ $log['timestamp'] ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- End Recent Activity -->

            </div>
        </section>

    </main><!-- End #main -->

@endsection
