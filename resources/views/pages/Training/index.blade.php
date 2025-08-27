@extends('layouts.app')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
            <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Training</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Data</a></li>
            </ol>
            </div>
        </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <!-- Hero Section -->
            <div class="card mb-4">
                <div class="card-body text-center py-5">
                    <h1 class="card-title">Welcome to Training Portal</h1>
                    <p class="card-subtitle text-muted">Explore various training programs to enhance your skills and compliance.</p>
                </div>
            </div>

            <!-- Training Cards -->
            <div class="row row-cards">
                <!-- General Knowledge -->
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <span class="avatar avatar-xl bg-blue-lt text-blue">GK</span>
                            </div>
                            <h3 class="card-title">General Knowledge</h3>
                            <p class="text-muted">Broaden your understanding across various domains.</p>
                            <a href="{{route('general.knowledge')}}" class="btn btn-primary btn-sm">Explore</a>
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
                            <a href="{{route('mandatory.training')}}" class="btn btn-danger btn-sm">View</a>
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
                            <a href="{{route('customer.requested')}}" class="btn btn-success btn-sm">Details</a>
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
                            <a href="{{route('license.training')}}" class="btn btn-warning btn-sm">Start</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection