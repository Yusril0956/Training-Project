@extends('layouts.dashboard')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="row g-0">
                    <div class="card-body">
                        <h3 class="card-title mb-4">Kotak Kritik & Saran</h3>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Pengirim</th>
                                        <th>Pesan</th>
                                        <th>Tanggal Kirim</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($feedback as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_pengirim }}</td>
                                            <td>{{ $item->pesan }}</td>
                                            <td>{{ $item->tanggal_kirim }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                {{-- <tbody>
                                    <!-- Contoh data statis, ganti dengan loop Laravel -->
                                    <tr>
                                        <td>1</td>
                                        <td>Rina</td>
                                        <td>Sistem training sangat membantu, semoga terus dikembangkan.</td>
                                        <td>2025-08-27</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Andi</td>
                                        <td>Mohon ditambahkan fitur reminder untuk jadwal pelatihan.</td>
                                        <td>2025-08-26</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Siti</td>
                                        <td>Website sudah bagus, tapi loading agak lambat di mobile.</td>
                                        <td>2025-08-25</td>
                                    </tr>
                                </tbody> --}}
                            </table>
                        </div>

                        <!-- Pagination (opsional) -->
                        <div class="mt-3">
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-end">
                                    <li class="page-item disabled">
                                        <a class="page-link">Previous</a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
