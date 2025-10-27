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
            background: #4a5568 !important;
            /* Darker gray for better contrast */
            z-index: 1055;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.25);
            transition: opacity 0.5s ease-in-out;
            opacity: 1;
            color: #151718ff;
            /* Light text */
        }

        .alert-fixed-top-right.fade {
            opacity: 0;
        }

        .settings-section {
            margin-bottom: 2rem;
        }

        .settings-card {
            border: 1px solid #cbd5e0;
            /* lighter border */
            border-radius: 0.75rem;
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            background: #edf2f7;
            /* light gray background */
            color: #2d3748;
            /* dark text */
        }

        .settings-card:hover {
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.15);
            transform: translateY(-3px);
        }

        .settings-card .card-header {
            background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e0 100%);
            border-bottom: 1px solid #a0aec0;
            font-weight: 700;
            padding: 1.5rem 2rem;
            border-radius: 0.75rem 0.75rem 0 0 !important;
            color: #2c5282;
            /* blue text */
        }

        .settings-card .card-body {
            padding: 2rem;
        }

        .section-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.25rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            background: #bee3f8;
            /* soft blue background */
            color: #2c5282;
            /* blue icon color */
        }

        /* Removed .access-icon, .danger-icon, .password-icon, .info-icon as they are unused */

        .feature-description {
            background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e0 100%);
            border-left: 4px solid #2c5282;
            padding: 1.25rem;
            margin: 1.5rem 0;
            border-radius: 0.5rem;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);
            color: #2d3748;
        }

        .action-button {
            position: relative;
        }

        .action-button .btn {
            transition: all 0.3s ease;
            border-radius: 0.5rem;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .action-button .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Removed .danger-zone styles as card is removed */

        .stats-card {
            background: linear-gradient(135deg, #ebf8ff 0%, #bee3f8 100%);
            border: 1px solid #90cdf4;
            border-radius: 0.75rem;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            color: #2c5282;
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2c5282;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .stats-label {
            color: #4a5568;
            font-weight: 600;
            font-size: 1rem;
        }

        .warning-text {
            color: #e53e3e;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .help-tooltip {
            cursor: help;
            border-bottom: 1px dotted #718096;
        }

        .tab-content {
            background: #edf2f7;
            border: 1px solid #cbd5e0;
            border-top: none;
            border-radius: 0 0 0.75rem 0.75rem;
            padding: 2.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            color: #2d3748;
        }

        .table thead th {
            background: #2c5282 !important;
            color: white !important;
        }

        .table tbody tr {
            background: #ffffff !important;
        }

        .table tbody tr:hover {
            background: #ebf8ff !important;
        }

        .nav-tabs .nav-link {
            border: 1px solid #cbd5e0;
            border-radius: 0.5rem 0.5rem 0 0;
            font-weight: 600;
            color: #4a5568;
            background: #cbd5e0;
            margin-right: 0.25rem;
            transition: all 0.3s ease;
        }

        .nav-tabs .nav-link:hover {
            background: #e2e8f0;
            color: #2c5282;
        }

        .nav-tabs .nav-link.active {
            background: #2c5282;
            color: white;
            border-color: #2c5282;
            box-shadow: 0 2px 8px rgba(44, 82, 130, 0.3);
        }

        /* Enhanced Role Badges */
        .role-badge {
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            border-radius: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            padding: 0.375rem 0.75rem;
            background: #bee3f8;
            color: #2c5282;
        }

        .role-badge:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            background: #2c5282;
            color: white;
        }

        .badge.bg-primary {
            background: linear-gradient(135deg, #2c5282 0%, #2a4365 100%) !important;
            color: white !important;
        }

        .badge.bg-info {
            background: linear-gradient(135deg, #3182ce 0%, #2b6cb0 100%) !important;
            color: white !important;
        }

        .badge.bg-success {
            background: linear-gradient(135deg, #38a169 0%, #2f855a 100%) !important;
            color: white !important;
        }

        /* Enhanced Button Visibility */
        .btn-group .btn {
            font-weight: 600;
            letter-spacing: 0.3px;
            border-width: 1px;
            border-radius: 0.5rem !important;
            transition: all 0.3s ease;
            margin: 0 0.125rem;
        }

        .btn-group .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-outline-warning {
            border-color: #d69e2e;
            color: #b7791f;
        }

        .btn-outline-warning:hover {
            background-color: #d69e2e;
            border-color: #d69e2e;
            color: white;
        }

        .btn-outline-danger {
            border-color: #c53030;
            color: #c53030;
        }

        .btn-outline-danger:hover {
            background-color: #c53030;
            border-color: #c53030;
            color: white;
        }

        /* Responsive improvements */
        @media (max-width: 768px) {
            .settings-card .card-body {
                padding: 1.5rem;
            }

            .tab-content {
                padding: 1.5rem;
            }

            .stats-number {
                font-size: 2rem;
            }

            .btn-group {
                flex-direction: column;
            }

            .btn-group .btn {
                margin: 0.125rem 0;
            }
        }

        /* Subtle animations */
        .settings-card,
        .role-badge,
        .action-button .btn {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

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

                    <!-- User Management -->
                    <div class="col-md-12">
                        <div class="card settings-card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-users me-2"></i>User Management
                                </h3>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Manage user accounts, reset passwords, and delete users</p>

                                <!-- Role Filter Tabs -->
                                <ul class="nav nav-tabs mb-3" id="userRoleTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="all-tab" data-bs-toggle="tab"
                                            data-bs-target="#all-users" type="button" role="tab" aria-controls="all-users"
                                            aria-selected="true">
                                            <i class="fas fa-users me-1"></i>All Users
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="admin-tab" data-bs-toggle="tab"
                                            data-bs-target="#admin-users" type="button" role="tab"
                                            aria-controls="admin-users" aria-selected="false">
                                            <i class="fas fa-user-shield me-1"></i>Admins
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="user-tab" data-bs-toggle="tab"
                                            data-bs-target="#regular-users" type="button" role="tab"
                                            aria-controls="regular-users" aria-selected="false">
                                            <i class="fas fa-user me-1"></i>Users
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="staff-tab" data-bs-toggle="tab"
                                            data-bs-target="#staff-users" type="button" role="tab"
                                            aria-controls="staff-users" aria-selected="false">
                                            <i class="fas fa-user-tie me-1"></i>Staff
                                        </button>
                                    </li>
                                </ul>

                                <!-- Tab Content -->
                                <div class="tab-content" id="userRoleTabsContent">
                                    <!-- All Users Tab -->
                                    <div class="tab-pane fade show active" id="all-users" role="tabpanel"
                                        aria-labelledby="all-tab">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th><i class="fas fa-user me-2"></i>Name</th>
                                                        <th><i class="fas fa-envelope me-2"></i>Email</th>
                                                        <th><i class="fas fa-tag me-2"></i>Role</th>
                                                        <th><i class="fas fa-cogs me-2"></i>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($users as $user)
                                                        @if (!$user->hasRole('Super Admin'))
                                                            <tr
                                                                data-role="{{ $user->roles->pluck('name')->first() ?? 'User' }}">
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="avatar avatar-sm me-3"
                                                                            style="background-image: url('{{ $user->avatar_url ? asset($user->avatar_url) : asset('images/default_avatar.png') }}')"
                                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                                            title="Phone: {{ $user->phone ?? 'N/A' }} | Address: {{ $user->address ?? 'N/A' }} | City: {{ $user->city ?? 'N/A' }}">
                                                                        </div>
                                                                        <div>
                                                                            <div class="fw-bold">{{ $user->name }}</div>
                                                                            <small
                                                                                class="text-muted">{{ $user->roles->pluck('name')->first() ?? 'User' }}</small>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>{{ $user->email }}</td>
                                                                <td>
                                                                    @php $userRole = $user->roles->pluck('name')->first() ?? 'User'; @endphp
                                                                    @if ($userRole === 'Admin')
                                                                        <span
                                                                            class="badge bg-primary text-white fw-bold px-3 py-2 role-badge">
                                                                            <i
                                                                                class="fas fa-user-shield me-1"></i>{{ $userRole }}
                                                                        </span>
                                                                    @elseif($userRole === 'Staff')
                                                                        <span
                                                                            class="badge bg-info text-dark fw-bold px-3 py-2 role-badge">
                                                                            <i
                                                                                class="fas fa-user-tie me-1"></i>{{ $userRole }}
                                                                        </span>
                                                                    @else
                                                                        <span
                                                                            class="badge bg-success text-white fw-bold px-3 py-2 role-badge">
                                                                            <i class="fas fa-user me-1"></i>{{ $userRole }}
                                                                        </span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <div class="btn-group" role="group">
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-outline-warning"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#resetPasswordModal"
                                                                            data-user-id="{{ $user->id }}"
                                                                            data-user-name="{{ $user->name }}">
                                                                            <i class="fas fa-key me-1"></i>Reset
                                                                        </button>
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-outline-danger"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#deleteUserModal"
                                                                            data-user-id="{{ $user->id }}"
                                                                            data-user-name="{{ $user->name }}">
                                                                            <i class="fas fa-trash me-1"></i>Delete
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Admin Users Tab -->
                                    <div class="tab-pane fade" id="admin-users" role="tabpanel" aria-labelledby="admin-tab">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th><i class="fas fa-user me-2"></i>Name</th>
                                                        <th><i class="fas fa-envelope me-2"></i>Email</th>
                                                        <th><i class="fas fa-cogs me-2"></i>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($users->filter(function ($user) {
                return $user->hasRole('Admin');
            }) as $user)
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar avatar-sm me-3"
                                                                        style="background-image: url('{{ $user->avatar_url ? asset($user->avatar_url) : asset('images/default_avatar.png') }}')"
                                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                                        title="Phone: {{ $user->phone ?? 'N/A' }} | Address: {{ $user->address ?? 'N/A' }} | City: {{ $user->city ?? 'N/A' }}">
                                                                    </div>
                                                                    <div>
                                                                        <div class="fw-bold">{{ $user->name }}</div>
                                                                        <small class="text-muted">Admin</small>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>
                                                                <div class="btn-group" role="group">
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-outline-warning"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#resetPasswordModal"
                                                                        data-user-id="{{ $user->id }}"
                                                                        data-user-name="{{ $user->name }}">
                                                                        <i class="fas fa-key me-1"></i>Reset
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Regular Users Tab -->
                                    <div class="tab-pane fade" id="regular-users" role="tabpanel"
                                        aria-labelledby="user-tab">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th><i class="fas fa-user me-2"></i>Name</th>
                                                        <th><i class="fas fa-envelope me-2"></i>Email</th>
                                                        <th><i class="fas fa-cogs me-2"></i>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($users->filter(function ($user) {
                return $user->hasRole('User');
            }) as $user)
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar avatar-sm me-3"
                                                                        style="background-image: url('{{ $user->avatar_url ? asset($user->avatar_url) : asset('images/default_avatar.png') }}')"
                                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                                        title="Phone: {{ $user->phone ?? 'N/A' }} | Address: {{ $user->address ?? 'N/A' }} | City: {{ $user->city ?? 'N/A' }}">
                                                                    </div>
                                                                    <div>
                                                                        <div class="fw-bold">{{ $user->name }}</div>
                                                                        <small class="text-muted">User</small>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>
                                                                <div class="btn-group" role="group">
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-outline-warning"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#resetPasswordModal"
                                                                        data-user-id="{{ $user->id }}"
                                                                        data-user-name="{{ $user->name }}">
                                                                        <i class="fas fa-key me-1"></i>Reset
                                                                    </button>
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-outline-danger"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteUserModal"
                                                                        data-user-id="{{ $user->id }}"
                                                                        data-user-name="{{ $user->name }}">
                                                                        <i class="fas fa-trash me-1"></i>Delete
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Staff Users Tab -->
                                    <div class="tab-pane fade" id="staff-users" role="tabpanel" aria-labelledby="staff-tab">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th><i class="fas fa-user me-2"></i>Name</th>
                                                        <th><i class="fas fa-envelope me-2"></i>Email</th>
                                                        <th><i class="fas fa-cogs me-2"></i>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($users->where('role', 'staff') as $user)
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar avatar-sm me-3"
                                                                        style="background-image: url('{{ $user->avatar_url ? asset($user->avatar_url) : asset('images/default_avatar.png') }}')"
                                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                                        title="Phone: {{ $user->phone ?? 'N/A' }} | Address: {{ $user->address ?? 'N/A' }} | City: {{ $user->city ?? 'N/A' }}">
                                                                    </div>
                                                                    <div>
                                                                        <div class="fw-bold">{{ $user->name }}</div>
                                                                        <small class="text-muted">Staff</small>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>
                                                                <div class="btn-group" role="group">
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-outline-warning"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#resetPasswordModal"
                                                                        data-user-id="{{ $user->id }}"
                                                                        data-user-name="{{ $user->name }}">
                                                                        <i class="fas fa-key me-1"></i>Reset
                                                                    </button>
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-outline-danger"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteUserModal"
                                                                        data-user-id="{{ $user->id }}"
                                                                        data-user-name="{{ $user->name }}">
                                                                        <i class="fas fa-trash me-1"></i>Delete
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Reset Password Modal -->
                                <div class="modal fade" id="resetPasswordModal" tabindex="-1"
                                    aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="resetPasswordModalLabel">
                                                    <i class="fas fa-key me-2"></i>Reset Password
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form id="resetPasswordForm" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="userName" class="form-label">User</label>
                                                        <input type="text" class="form-control" id="userName" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="newPassword" class="form-label">New Password</label>
                                                        <input type="password" class="form-control" id="newPassword"
                                                            name="new_password" required minlength="6">
                                                        <div class="form-text">Password must be at least 6 characters long.
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="confirmPassword" class="form-label">Confirm
                                                            Password</label>
                                                        <input type="password" class="form-control" id="confirmPassword"
                                                            required>
                                                        <div id="passwordMatch" class="form-text text-danger"
                                                            style="display: none;">Passwords do not match.</div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-warning" id="resetBtn">
                                                        <i class="fas fa-save me-1"></i>Reset Password
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete User Modal -->
                                <div class="modal fade" id="deleteUserModal" tabindex="-1"
                                    aria-labelledby="deleteUserModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteUserModalLabel">
                                                    <i class="fas fa-trash me-2"></i>Delete User
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form id="deleteUserForm" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body">
                                                    <div class="alert alert-danger">
                                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                                        <strong>Warning!</strong> This action cannot be undone. Are you sure you
                                                        want to delete this user?
                                                    </div>
                                                    <p>Deleting this user will permanently remove their account and all
                                                        associated data.</p>
                                                    <div class="mb-3">
                                                        <label for="deleteUserName" class="form-label">User to Delete</label>
                                                        <input type="text" class="form-control" id="deleteUserName"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger" id="deleteBtn">
                                                        <i class="fas fa-trash me-1"></i>Delete User
                                                    </button>
                                                </div>
                                            </form>
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
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

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

                // Handle reset password modal
                const resetPasswordModal = document.getElementById('resetPasswordModal');
                const resetPasswordForm = document.getElementById('resetPasswordForm');
                const userNameInput = document.getElementById('userName');
                const newPasswordInput = document.getElementById('newPassword');
                const confirmPasswordInput = document.getElementById('confirmPassword');
                const passwordMatchDiv = document.getElementById('passwordMatch');
                const resetBtn = document.getElementById('resetBtn');

                resetPasswordModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const userId = button.getAttribute('data-user-id');
                    const userName = button.getAttribute('data-user-name');

                    userNameInput.value = userName;
                    resetPasswordForm.action = `/admin/settings/reset-password/${userId}`;
                    newPasswordInput.value = '';
                    confirmPasswordInput.value = '';
                    passwordMatchDiv.style.display = 'none';
                    resetBtn.disabled = true;
                });

                // Password confirmation validation
                function validatePasswords() {
                    const password = newPasswordInput.value;
                    const confirmPassword = confirmPasswordInput.value;

                    if (password && confirmPassword) {
                        if (password === confirmPassword) {
                            passwordMatchDiv.style.display = 'none';
                            resetBtn.disabled = false;
                        } else {
                            passwordMatchDiv.style.display = 'block';
                            resetBtn.disabled = true;
                        }
                    } else {
                        passwordMatchDiv.style.display = 'none';
                        resetBtn.disabled = true;
                    }
                }

                newPasswordInput.addEventListener('input', validatePasswords);
                confirmPasswordInput.addEventListener('input', validatePasswords);

                // Reset form when modal is hidden
                resetPasswordModal.addEventListener('hidden.bs.modal', function() {
                    resetPasswordForm.reset();
                    passwordMatchDiv.style.display = 'none';
                    resetBtn.disabled = true;
                });

                // Handle delete user modal
                const deleteUserModal = document.getElementById('deleteUserModal');
                const deleteUserForm = document.getElementById('deleteUserForm');
                const deleteUserNameInput = document.getElementById('deleteUserName');
                const deleteBtn = document.getElementById('deleteBtn');

                deleteUserModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const userId = button.getAttribute('data-user-id');
                    const userName = button.getAttribute('data-user-name');

                    deleteUserNameInput.value = userName;
                    deleteUserForm.action = `/admin/user/${userId}`;
                });

                // Reset form when delete modal is hidden
                deleteUserModal.addEventListener('hidden.bs.modal', function() {
                    deleteUserForm.reset();
                });
            });
        </script>
    @endpush
