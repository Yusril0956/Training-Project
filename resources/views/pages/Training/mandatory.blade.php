@extends('layouts.app')
@section('title', 'Mandatory')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('success') }}
                    <a href="#" class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif
            @include('partials._breadcrumb', [
                'items' => [
                    ['title' => 'Training', 'url' => route('training.index')],
                    ['title' => 'Customer Requested', 'url' => route('customer.requested')],
                ],
            ])
            <!-- Hero Section -->
            <div class="card mb-3">
                <div class="card-body text-center py-4">
                    <h2 class="card-title">Customer Requested Training</h2>
                    <p class="card-subtitle text-muted">Daftar pelatihan yang diajukan langsung oleh klien atau mitra kerja
                    </p>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Daftar training yang tersedia</h3>
                </div>
            </div>
            {{-- <div class="card-body"> --}}
            <div class="row row-cards mb-3">
                @foreach ($trainings as $training)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm">
                            <img src="{{ $training->image_url ?? asset('images/default-training.jpg') }}"
                                class="card-img-top" alt="Gambar Kelas">

                            <div class="card-body">
                                <h4 class="card-title">{{ $training->name }}</h4>
                                <p class="text-muted">{{ Str::limit($training->description, 80) }}</p>

                                <div class="d-flex justify-content-between align-items-center">
                                    @auth
                                            @php
                                                // cek apakah user sudah jadi member
                                                $isMember = $training->members->contains('user_id', Auth::id());
                                            @endphp

                                            @if ($isMember || Auth::user()->hasAnyRole(['Admin', 'Super Admin']))
                                                <a href="{{ route('cr.page', $training->id) }}" class="btn btn-sm btn-primary">Lihat</a>
                                            @else
                                                <a href="{{ route('training.register.form', $training->id)}}" class="btn-primary">Daftar</a>
                                            @endif

                                    @endauth

                                    @guest
                                        <a href="{{ route('login') }}" class="btn btn-sm btn-primary">
                                            Login untuk Daftar
                                        </a>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if ($trainings->isEmpty())
                    <div class="col-12">
                        <div class="alert alert-warning text-center">
                            Belum ada kelas training yang tersedia.
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
