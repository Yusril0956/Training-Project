@extends('layouts.app')

@section('title', 'Statistik Produksi')

@push('styles')
    <style>
        .stat-card {
            transition: transform 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-2px);
        }
        .production-chart {
            height: 300px;
            position: relative;
            z-index: 1;
        }
        .capacity-indicator {
            position: relative;
            height: 20px;
            background-color: #e9ecef;
            border-radius: 10px;
            overflow: hidden;
        }
        .capacity-fill {
            height: 100%;
            border-radius: 10px;
            transition: width 0.5s ease;
        }
    </style>
@endpush

@section('content')
    <div class="page-body">
        <div class="container-xl">

            <!-- Header -->
            <div class="card mb-4">
                <div class="card-body text-center py-4">
                    <h1 class="card-title">Statistik Produksi PT Dirgantara Indonesia</h1>
                    <p class="card-subtitle text-muted">Data produksi pesawat dan sistem persenjataan hingga 2024</p>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="row row-cards mb-4">
                <div class="col-md-3">
                    <div class="card stat-card">
                        <div class="card-body text-center">
                            <div class="text-muted mb-1">Total Pesawat Diproduksi</div>
                            <div class="h2 mb-0">193</div>
                            <div class="text-success small">+12% dari tahun lalu</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card">
                        <div class="card-body text-center">
                            <div class="text-muted mb-1">Kapasitas Produksi Tahunan</div>
                            <div class="h2 mb-0">13</div>
                            <div class="text-muted small">unit/tahun</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card">
                        <div class="card-body text-center">
                            <div class="text-muted mb-1">Roket & Munisi</div>
                            <div class="h2 mb-0">83.000+</div>
                            <div class="text-muted small">unit diproduksi</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card">
                        <div class="card-body text-center">
                            <div class="text-muted mb-1">Proyek Berjalan</div>
                            <div class="h2 mb-0">7</div>
                            <div class="text-muted small">proyek aktif</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CN-235 Series Section -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">CN-235 Series</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <h5>Total Produksi: 70 unit (hingga 2024)</h5>
                                <p class="text-muted">PTDI telah memproduksi dan mengirimkan sebanyak 70 unit pesawat CN-235 series ke berbagai pelanggan internasional hingga 2024.</p>
                            </div>
                            <div class="mb-3">
                                <h6>Kapasitas Produksi Tahunan</h6>
                                <div class="d-flex align-items-center mb-2">
                                    <span class="me-3">8 unit/tahun</span>
                                    <div class="capacity-indicator flex-fill">
                                        <div class="capacity-fill bg-success" style="width: 80%"></div>
                                    </div>
                                </div>
                                <small class="text-muted">Setelah revitalisasi dan reformasi prosedur kerja, kapasitas meningkat dari 2–3 menjadi 8 unit/tahun</small>
                            </div>
                            <div class="alert alert-info">
                                <strong>Proyek Berjalan:</strong> CN-235-220 Military Transport untuk TNI AL (unit ke-7 sedang diselesaikan, target Februari 2025)
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div id="cn235-chart" class="production-chart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- NC212i Series Section -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">NC212i Series</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <h5>Total Produksi: 123 unit (2014–sekarang)</h5>
                                <p class="text-muted">Sejak 2014, PTDI adalah satu-satunya pabrikan NC212i. Hingga kini, telah diproduksi dan dikirim sebanyak 123 unit NC212 series ke pelanggan global, dari total populasi 606 unit di dunia.</p>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <div class="card bg-light">
                                        <div class="card-body text-center">
                                            <div class="h4 mb-1">6</div>
                                            <div class="text-muted small">Unit diekspor ke Filipina</div>
                                            <div class="text-primary">Rp 1,2 triliun (US$ 79 juta)</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card bg-light">
                                        <div class="card-body text-center">
                                            <div class="h4 mb-1">9</div>
                                            <div class="text-muted small">Unit dipesan TNI AU</div>
                                            <div class="text-success">Unit ke-7 selesai Feb 2025</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div id="nc212-chart" class="production-chart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sistem Roket & Munisi Section -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Sistem Roket & Munisi</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border-primary mb-3">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">FFAR & WAFAR 70 mm Rockets</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="text-center">
                                                <div class="h3 mb-1">43.000+</div>
                                                <div class="text-muted small">Unit diproduksi</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-center">
                                                <div class="h3 mb-1">10.000</div>
                                                <div class="text-muted small">Kapasitas/tahun</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="capacity-indicator">
                                            <div class="capacity-fill bg-primary" style="width: 85%"></div>
                                        </div>
                                        <small class="text-muted mt-1 d-block">Kapasitas produksi saat ini</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-success mb-3">
                                <div class="card-body">
                                    <h5 class="card-title text-success">Warhead 70 mm</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="text-center">
                                                <div class="h3 mb-1">40.000+</div>
                                                <div class="text-muted small">Unit diproduksi</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-center">
                                                <div class="h3 mb-1">5.000</div>
                                                <div class="text-muted small">Kapasitas/tahun</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="capacity-indicator">
                                            <div class="capacity-fill bg-success" style="width: 70%"></div>
                                        </div>
                                        <small class="text-muted mt-1 d-block">Kapasitas produksi saat ini</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="munitions-chart" class="production-chart mt-4"></div>
                </div>
            </div>

            <!-- Training & Development Section -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Training & Development</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card stat-card">
                                <div class="card-body text-center">
                                    <div class="text-muted mb-1">Total Training Programs</div>
                                    <div class="h2 mb-0">4</div>
                                    <div class="text-muted small">Active programs</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card stat-card">
                                <div class="card-body text-center">
                                    <div class="text-muted mb-1">Participants</div>
                                    <div class="h2 mb-0">1,250</div>
                                    <div class="text-success small">+15% from last year</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card stat-card">
                                <div class="card-body text-center">
                                    <div class="text-muted mb-1">Completion Rate</div>
                                    <div class="h2 mb-0">87%</div>
                                    <div class="text-muted small">Average</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card stat-card">
                                <div class="card-body text-center">
                                    <div class="text-muted mb-1">Certifications</div>
                                    <div class="h2 mb-0">950</div>
                                    <div class="text-muted small">Issued</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card border-info mb-3">
                                <div class="card-body">
                                    <h5 class="card-title text-info">General Knowledge</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="text-center">
                                                <div class="h4 mb-1">450</div>
                                                <div class="text-muted small">Participants</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-center">
                                                <div class="h4 mb-1">92%</div>
                                                <div class="text-muted small">Completion</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-danger mb-3">
                                <div class="card-body">
                                    <h5 class="card-title text-danger">Mandatory Training</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="text-center">
                                                <div class="h4 mb-1">800</div>
                                                <div class="text-muted small">Participants</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-center">
                                                <div class="h4 mb-1">95%</div>
                                                <div class="text-muted small">Completion</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card border-success mb-3">
                                <div class="card-body">
                                    <h5 class="card-title text-success">Customer Requested</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="text-center">
                                                <div class="h4 mb-1">120</div>
                                                <div class="text-muted small">Participants</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-center">
                                                <div class="h4 mb-1">78%</div>
                                                <div class="text-muted small">Completion</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-warning mb-3">
                                <div class="card-body">
                                    <h5 class="card-title text-warning">License & Certification</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="text-center">
                                                <div class="h4 mb-1">300</div>
                                                <div class="text-muted small">Participants</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-center">
                                                <div class="h4 mb-1">85%</div>
                                                <div class="text-muted small">Completion</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="training-chart" class="production-chart mb-4"></div>

                    <div class="text-center">
                        <a href="{{ route('training.index') }}" class="btn btn-primary">
                            <i class="ti ti-school me-2"></i>Access Training Portal
                        </a>
                    </div>
                </div>
            </div>

            <!-- Ringkasan & Insight -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Ringkasan & Insight</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-success">Peningkatan Kapasitas</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="ti ti-check text-success me-2"></i>CN-235: Kapasitas meningkat 167% (2-3 → 8 unit/tahun)</li>
                                <li class="mb-2"><i class="ti ti-check text-success me-2"></i>NC212i: Produksi konsisten sejak 2014</li>
                                <li class="mb-2"><i class="ti ti-check text-success me-2"></i>Roket & Munisi: Kapasitas ribuan unit per tahun</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-primary">Permintaan Global</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="ti ti-trending-up text-primary me-2"></i>Permintaan tinggi untuk CN-235 series</li>
                                <li class="mb-2"><i class="ti ti-globe text-primary me-2"></i>Ekspor ke Filipina senilai Rp 1,2 triliun</li>
                                <li class="mb-2"><i class="ti ti-shield text-primary me-2"></i>KP III Tasikmalaya sebagai pusat produksi munisi</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="text-center mb-4">
                <a href="{{ route('index') }}" class="btn btn-secondary">
                    <i class="ti ti-arrow-left me-2"></i>Kembali ke Home
                </a>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // CN-235 Production Chart
        const cn235Options = {
            series: [{
                name: 'Produksi CN-235',
                data: [2, 3, 5, 7, 8, 8, 8, 8, 8, 8, 8] // Sample yearly data
            }],
            chart: {
                type: 'area',
                height: 300,
                toolbar: { show: false },
                animations: { enabled: false }
            },
            colors: ['#0054a6'],
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 2 },
            xaxis: {
                categories: ['2014', '2015', '2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023', '2024']
            },
            yaxis: {
                title: { text: 'Unit Produksi' }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'light',
                    type: 'vertical',
                    opacityFrom: 0.4,
                    opacityTo: 0.1,
                }
            }
        };
        const cn235Chart = new ApexCharts(document.querySelector("#cn235-chart"), cn235Options);
        cn235Chart.render();

        // NC212i Production Chart
        const nc212Options = {
            series: [{
                name: 'Produksi NC212i',
                data: [15, 18, 22, 25, 28, 30, 32, 35, 38, 40, 42] // Sample yearly data
            }],
            chart: {
                type: 'bar',
                height: 300,
                toolbar: { show: false },
                animations: { enabled: false }
            },
            colors: ['#28a745'],
            plotOptions: {
                bar: { borderRadius: 4 }
            },
            xaxis: {
                categories: ['2014', '2015', '2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023', '2024']
            },
            yaxis: {
                title: { text: 'Unit Produksi' }
            }
        };
        const nc212Chart = new ApexCharts(document.querySelector("#nc212-chart"), nc212Options);
        nc212Chart.render();

        // Munitions Production Chart
        const munitionsOptions = {
            series: [{
                name: 'FFAR & WAFAR Rockets',
                data: [8000, 8500, 9000, 9500, 10000, 10500, 11000, 11500, 12000, 12500, 13000]
            }, {
                name: 'Warhead 70mm',
                data: [4000, 4200, 4400, 4600, 4800, 5000, 5200, 5400, 5600, 5800, 6000]
            }],
            chart: {
                type: 'line',
                height: 300,
                toolbar: { show: false },
                animations: { enabled: false }
            },
            colors: ['#007bff', '#ffc107'],
            stroke: { width: 3 },
            xaxis: {
                categories: ['2014', '2015', '2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023', '2024']
            },
            yaxis: {
                title: { text: 'Unit Produksi' }
            },
            legend: {
                position: 'top'
            }
        };
        const munitionsChart = new ApexCharts(document.querySelector("#munitions-chart"), munitionsOptions);
        munitionsChart.render();

        // Training Participation Chart
        const trainingOptions = {
            series: [{
                name: 'Participants',
                data: [350, 400, 450, 500, 550, 600, 650, 700, 750, 800, 850] // Sample yearly data
            }],
            chart: {
                type: 'bar',
                height: 300,
                toolbar: { show: false },
                animations: { enabled: false }
            },
            colors: ['#17a2b8'],
            plotOptions: {
                bar: { borderRadius: 4 }
            },
            xaxis: {
                categories: ['2014', '2015', '2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023', '2024']
            },
            yaxis: {
                title: { text: 'Number of Participants' }
            }
        };
        const trainingChart = new ApexCharts(document.querySelector("#training-chart"), trainingOptions);
        trainingChart.render();
    </script>
@endpush
