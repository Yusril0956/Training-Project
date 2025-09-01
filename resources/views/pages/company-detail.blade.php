@extends('layouts.app')

@section('title', 'Detail Perusahaan - PT Dirgantara Indonesia')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detail Perusahaan</h3>
                            <div class="card-actions">
                                <a href="{{ route('index') }}" class="btn btn-secondary btn-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M5 12l14 0" />
                                        <path d="M5 12l6 6" />
                                        <path d="M5 12l6 -6" />
                                    </svg>
                                    Kembali ke Home
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Aspek</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Nama</strong></td>
                                            <td>PT Dirgantara Indonesia (PTDI)</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Didirikan</strong></td>
                                            <td>Agustus 1976</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Bidang Usaha</strong></td>
                                            <td>Desain, manufaktur, MRO, aerospace sipil & militer</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Produk Unggulan</strong></td>
                                            <td>NC212i, CN235, N219, CN295 (kerja sama Airbus)</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Visi</strong></td>
                                            <td>Leader turboprop di Asia Pasifik</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Misi</strong></td>
                                            <td>Kompetensi, aliansi global, produk/jasa kompetitif</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Direksi & Komisaris</strong></td>
                                            <td>Gita Amperiawan dkk., dengan latar belakang kuat</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Anak Perusahaan</strong></td>
                                            <td>IPTN NA, GENTS, GETI, Nusantara Turbin & Propulsi</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Sistem Senjata & Roket</strong></td>
                                            <td>Produksi teknologi roket & rudal</td>
                                        </tr>
                                        <tr>
                                            <td><strong>PPID & Info Publik</strong></td>
                                            <td>Portal resmi tersedia untuk publik</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
