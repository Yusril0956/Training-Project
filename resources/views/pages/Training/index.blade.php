@extends('layouts.app')
@section('title', 'Training')

@section('content')
    <!-- Page body -->
    <div class="page-body pt-2">
        <div class="container-xl">
            
            @include('partials._breadcrumb', [
                'items' => [['title' => 'Training', 'url' => route('training.index')]],
            ])



            <!-- Hero Section -->
            <div class="card mb-4">
                <div class="card-body text-center py-5">
                    <h1 class="card-title">Welcome to Training Portal</h1>
                    <p class="card-subtitle text-muted">Explore various training programs to enhance your skills and
                        compliance.</p>
                </div>
            </div>

            <!-- Training Cards -->
            <div class="row row-cards mb-4">
                <!-- General Knowledge -->
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <span class="avatar avatar-xl bg-blue-lt text-blue">GK</span>
                            </div>
                            <h3 class="card-title">General Knowledge</h3>
                            <p class="text-muted">Broaden your understanding across various domains.</p>
                            <a href="{{ route('general.knowledge') }}" class="btn btn-primary btn-sm">Explore</a>
                        </div>
                    </div>
                </div>

                <!-- Mandatory -->
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <span class="avatar avatar-xl bg-red-lt text-red">MD</span>
                            </div>
                            <h3 class="card-title">Mandatory</h3>
                            <p class="text-muted">Required trainings for compliance and safety.</p>
                            <a href="{{ route('mandatory.training') }}" class="btn btn-danger btn-sm">View</a>
                        </div>
                    </div>
                </div>

                <!-- Customer Requested -->
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <span class="avatar avatar-xl bg-green-lt text-green">CR</span>
                            </div>
                            <h3 class="card-title">Customer Requested</h3>
                            <p class="text-muted">Tailored trainings based on client needs.</p>
                            <a href="{{ route('customer.requested') }}" class="btn btn-success btn-sm">Details</a>
                        </div>
                    </div>
                </div>

                <!-- License -->
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <span class="avatar avatar-xl bg-yellow-lt text-yellow">LC</span>
                            </div>
                            <h3 class="card-title">License</h3>
                            <p class="text-muted">Certifications and licensed training programs.</p>
                            <a href="{{ route('license.training') }}" class="btn btn-warning btn-sm">Start</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Kalender Training</h3>
                </div>
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>


            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Rekomendasi Training</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Pelatihan Audit Internal ISO 9001</li>
                        <li class="list-group-item">Simulasi Emergency Response</li>
                        <li class="list-group-item">Training Sistem Avionik Dasar</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '{{ route('calendar.events') }}',
                eventClick: function(info) {
                    alert('Training: ' + info.event.title);
                }
            });

            calendar.render();
        });
    </script>
@endpush


@endsection
