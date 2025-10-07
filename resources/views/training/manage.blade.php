@extends('layouts.dashboard')
@section('title', 'Manajemen Pelatihan')

@section('content')
    <div class="page-body">
        <div class="container-xl">

            <!-- Page Header -->
            <div class="d-flex mb-4">
                <div class="flex-fill">
                    <h2 class="page-title">📚 Manajemen Pelatihan</h2>
                    <p class="text-muted">
                        Buat, edit, dan hapus pelatihan untuk semua jenis: General Knowledge, Mandatory, Customer Requested,
                        dan License.
                    </p>
                </div>
            </div>

            <livewire:training-search page-type="admin" />

        </div>
    </div>
@endsection
