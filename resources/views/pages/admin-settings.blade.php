@extends('layouts.app')

@section('title', 'Admin Settings')

@push('styles')
    <style>
        .alert-fixed-top-right {
            position: fixed;
            top: 24px;
            right: 24px;
            min-width: 300px;
            margin-top: 33px;
            background: #fff !important;
            z-index: 1055;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.15);
            transition: opacity 0.5s ease-in-out;
            opacity: 1;
        }

        .alert-fixed-top-right.fade {
            opacity: 0;
        }

        .settings-section {
            margin-bottom: 2rem;
        }

        .settings-card {
            border: 1px solid #e3e6f0;
            border-radius: 0.5rem;
            box-shadow: 0 0.15rem 0.3rem rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .settings-card:hover {
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.15);
        }

        .settings-card .card-header {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-bottom: 1px solid #e3e6f0;
            font-weight: 600;
            padding: 1.25rem 1.5rem;
        }

        .settings-card .card-body {
            padding: 1.5rem;
        }

        .section-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.2rem;
        }

        .access-icon { background-color: #d4edda; color: #155724; }
        .password-icon { background-color: #fff3cd; color: #856404; }
        .danger-icon { background-color: #f8d7da; color: #721c24; }
        .info-icon { background-color: #d1ecf1; color: #0c5460; }

        .feature-description {
            background-color: #f8f9fc;
            border-left: 4px solid #007bff;
            padding: 1rem;
            margin: 1rem 0;
            border-radius: 0.25rem;
        }

        .action-button {
            position: relative;
        }

        .action-button .btn {
            transition: all 0.3s ease;
        }

        .action-button .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .danger-zone {
            border: 2px solid #dc3545;
            background: linear-gradient(135deg, #fff5f5 0%, #fed7d7 100%);
        }

        .danger-zone .card-header {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
            border-bottom: 2px solid #dc3545;
        }

        .stats-card {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            border: 1px solid #2196f3;
            border-radius: 0.5rem;
            padding: 1.5rem;
            text-align: center;
        }

        .stats-number {
            font-size: 2rem;
            font-weight: bold;
            color: #1976d2;
        }

        .stats-label {
            color: #424242;
            font-weight: 500;
        }

        .warning-text {
            color: #dc3545;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .help-tooltip {
            cursor: help;
            border-bottom: 1px dotted #6c757d;
        }

        .tab-content {
            background: white;
            border: 1px solid #dee2e6;
            border-top: none;
            border-radius: 0 0 0.5rem 0.5rem;
            padding: 2rem;
        }

        .nav-tabs .nav-link {
            border: 1px solid transparent;
            border-radius: 0.5rem 0.5rem 0 0;
            font-weight: 500;
        }

        .nav-tabs .nav-link.active {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }
    </style>
@endpush

@section('content')
    <div class="page-body">
        <div class="container-xl">

            <!-- Page Header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 class="page-title">Admin Settings</h2>
                            <div class="text-muted mt-1">Manage system settings and user access</div>
                        </div>
                    </div>
                </div>
            </div>

            @include('components._alert')

            <!-- Settings Cards -->
            <div class="row row-cards">

                <!-- Access Management -->
                <div class="col-md-6">
                    <div class="card settings-card">
                        <div class="card-header">
                            <h3 class="card-title">Access Management</h3>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Control system-wide access permissions</p>

                            <form action="{{ route('admin.open.access') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success w-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z" />
                                        <path d="M11 16a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                        <path d="M8 11v-4a4 4 0 1 1 8 0v4" />
                                    </svg>
                                    Open All Access
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- User Password Management -->
                <div class="col-md-6">
                    <div class="card settings-card">
                        <div class="card-header">
                            <h3 class="card-title">User Password Management</h3>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Reset passwords for users</p>

                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                            @if($user->role !== 'super_admin')
                                                <tr>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        <form action="{{ route('admin.reset.password', $user->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-warning"
                                                                    onclick="return confirm('Are you sure you want to reset the password for {{ $user->name }}?')">
                                                                Reset Password
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- System Management -->
                <div class="col-md-12">
                    <div class="card settings-card danger-zone">
                        <div class="card-header">
                            <h3 class="card-title">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 9v4" />
                                    <path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.871l-8.106 -13.534a1.914 1.914 0 0 0 -3.274 0z" />
                                    <path d="M12 16h.01" />
                                </svg>
                                Danger Zone
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Database Management</h4>
                                    <p class="text-muted">Irreversible actions that affect the entire system</p>

                                    <form action="{{ route('admin.delete.database') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('WARNING: This will delete all data! Are you absolutely sure?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M4 7l16 0" />
                                                <path d="M10 11l0 6" />
                                                <path d="M14 11l0 6" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg>
                                            Delete Database
                                        </button>
                                    </form>
                                </div>

                                <div class="col-md-6">
                                    <h4>System Information</h4>
                                    <div class="mb-2">
                                        <strong>Total Users:</strong> {{ $users->count() }}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Admin Users:</strong> {{ $users->where('role', 'admin')->count() }}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Super Admin:</strong> {{ $users->where('role', 'super_admin')->count() }}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Regular Users:</strong> {{ $users->where('role', 'user')->count() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Auto dismiss alert after 4 seconds
            setTimeout(function() {
                document.querySelectorAll('.alert-fixed-top-right').forEach(function(alert) {
                    if (alert) alert.classList.add('fade');
                    setTimeout(function() {
                        if (alert) alert.remove();
                    }, 500);
                });
            }, 4000);

            // Dismiss alert on scroll
            let alertDismissed = false;
            window.addEventListener('scroll', function() {
                if (!alertDismissed) {
                    document.querySelectorAll('.alert-fixed-top-right').forEach(function(alert) {
                        if (alert) alert.classList.add('fade');
                        setTimeout(function() {
                            if (alert) alert.remove();
                        }, 500);
                    });
                    alertDismissed = true;
                }
            });
        });
    </script>
@endpush
