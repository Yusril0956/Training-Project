@extends('layouts.dashboard')
@section('title', 'Manajemen Pelatihan')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                {{-- Kolom kiri: breadcrumb --}}
                <div class="col">
                    @include('partials._breadcrumb', [
                        'items' => [['title' => 'Training Manage', 'url' => route('training.manage')]],
                    ])
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">

            <livewire:admin.training-manage />

        </div>
    </div>
@endsection
