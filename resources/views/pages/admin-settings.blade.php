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

        /* Enhanced Role Badges */
        .role-badge {
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            border-radius: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .role-badge:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .badge.bg-primary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important;
        }

        .badge.bg-info {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%) !important;
        }

        .badge.bg-success {
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%) !important;
        }

        /* Enhanced Button Visibility */
        .btn-group .btn {
            font-weight: 600;
            letter-spacing: 0.3px;
            border-width: 2px;
            transition: all 0.3s ease;
        }

        .btn-group .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-outline-warning:hover {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
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
                                    <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all-users" type="button" role="tab" aria-controls="all-users" aria-selected="true">
                                        <i class="fas fa-users me-1"></i>All Users
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin-users" type="button" role="tab" aria-controls="admin-users" aria-selected="false">
                                        <i class="fas fa-user-shield me-1"></i>Admins
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="user-tab" data-bs-toggle="tab" data-bs-target="#regular-users" type="button" role="tab" aria-controls="regular-users" aria-selected="false">
                                        <i class="fas fa-user me-1"></i>Users
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="staff-tab" data-bs-toggle="tab" data-bs-target="#staff-users" type="button" role="tab" aria-controls="staff-users" aria-selected="false">
                                        <i class="fas fa-user-tie me-1"></i>Staff
                                    </button>
                                </li>
                            </ul>

                            <!-- Tab Content -->
                            <div class="tab-content" id="userRoleTabsContent">
                                <!-- All Users Tab -->
                                <div class="tab-pane fade show active" id="all-users" role="tabpanel" aria-labelledby="all-tab">
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
                                                @foreach($users as $user)
                                                    @if($user->role !== 'super_admin')
                                                        <tr data-role="{{ $user->role }}">
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar avatar-sm me-3" style="background-image: url('{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('images/default_avatar.png') }}')"></div>
                                                                    <div>
                                                                        <div class="fw-bold">{{ $user->name }}</div>
                                                                        <small class="text-muted">{{ ucfirst($user->role) }}</small>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>
                                                                @if($user->role === 'admin')
                                                                    <span class="badge bg-primary text-white fw-bold px-3 py-2 role-badge">
                                                                        <i class="fas fa-user-shield me-1"></i>{{ ucfirst($user->role) }}
                                                                    </span>
                                                                @elseif($user->role === 'staff')
                                                                    <span class="badge bg-info text-dark fw-bold px-3 py-2 role-badge">
                                                                        <i class="fas fa-user-tie me-1"></i>{{ ucfirst($user->role) }}
                                                                    </span>
                                                                @else
                                                                    <span class="badge bg-success text-white fw-bold px-3 py-2 role-badge">
                                                                        <i class="fas fa-user me-1"></i>{{ ucfirst($user->role) }}
                                                                    </span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="btn-group" role="group">
                                                                    <button type="button" class="btn btn-sm btn-outline-warning"
                                                                            data-bs-toggle="modal" data-bs-target="#resetPasswordModal"
                                                                            data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}">
                                                                        <i class="fas fa-key me-1"></i>Reset
                                                                    </button>
                                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                                            data-bs-toggle="modal" data-bs-target="#deleteUserModal"
                                                                            data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}">
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
                                                @foreach($users->where('role', 'admin') as $user)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar avatar-sm me-3" style="background-image: url('{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('images/default_avatar.png') }}')"></div>
                                                                <div>
                                                                    <div class="fw-bold">{{ $user->name }}</div>
                                                                    <small class="text-muted">Admin</small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                <button type="button" class="btn btn-sm btn-outline-warning"
                                                                        data-bs-toggle="modal" data-bs-target="#resetPasswordModal"
                                                                        data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}">
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
                                <div class="tab-pane fade" id="regular-users" role="tabpanel" aria-labelledby="user-tab">
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
                                                @foreach($users->where('role', 'user') as $user)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar avatar-sm me-3" style="background-image: url('{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('images/default_avatar.png') }}')"></div>
                                                                <div>
                                                                    <div class="fw-bold">{{ $user->name }}</div>
                                                                    <small class="text-muted">User</small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                <button type="button" class="btn btn-sm btn-outline-warning"
                                                                        data-bs-toggle="modal" data-bs-target="#resetPasswordModal"
                                                                        data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}">
                                                                    <i class="fas fa-key me-1"></i>Reset
                                                                </button>
                                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                                        data-bs-toggle="modal" data-bs-target="#deleteUserModal"
                                                                        data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}">
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
                                                @foreach($users->where('role', 'staff') as $user)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar avatar-sm me-3" style="background-image: url('{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('images/default_avatar.png') }}')"></div>
                                                                <div>
                                                                    <div class="fw-bold">{{ $user->name }}</div>
                                                                    <small class="text-muted">Staff</small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                <button type="button" class="btn btn-sm btn-outline-warning"
                                                                        data-bs-toggle="modal" data-bs-target="#resetPasswordModal"
                                                                        data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}">
                                                                    <i class="fas fa-key me-1"></i>Reset
                                                                </button>
                                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                                        data-bs-toggle="modal" data-bs-target="#deleteUserModal"
                                                                        data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}">
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
                            <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="resetPasswordModalLabel">
                                                <i class="fas fa-key me-2"></i>Reset Password
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                    <input type="password" class="form-control" id="newPassword" name="new_password" required minlength="6">
                                                    <div class="form-text">Password must be at least 6 characters long.</div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                                                    <input type="password" class="form-control" id="confirmPassword" required>
                                                    <div id="passwordMatch" class="form-text text-danger" style="display: none;">Passwords do not match.</div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-warning" id="resetBtn">
                                                    <i class="fas fa-save me-1"></i>Reset Password
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete User Modal -->
                            <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteUserModalLabel">
                                                <i class="fas fa-trash me-2"></i>Delete User
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form id="deleteUserForm" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body">
                                                <div class="alert alert-danger">
                                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                                    <strong>Warning!</strong> This action cannot be undone. Are you sure you want to delete this user?
                                                </div>
                                                <p>Deleting this user will permanently remove their account and all associated data.</p>
                                                <div class="mb-3">
                                                    <label for="deleteUserName" class="form-label">User to Delete</label>
                                                    <input type="text" class="form-control" id="deleteUserName" readonly>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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

            // Handle reset password modal
            const resetPasswordModal = document.getElementById('resetPasswordModal');
            const resetPasswordForm = document.getElementById('resetPasswordForm');
            const userNameInput = document.getElementById('userName');
            const newPasswordInput = document.getElementById('newPassword');
            const confirmPasswordInput = document.getElementById('confirmPassword');
            const passwordMatchDiv = document.getElementById('passwordMatch');
            const resetBtn = document.getElementById('resetBtn');

            resetPasswordModal.addEventListener('show.bs.modal', function (event) {
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
            resetPasswordModal.addEventListener('hidden.bs.modal', function () {
                resetPasswordForm.reset();
                passwordMatchDiv.style.display = 'none';
                resetBtn.disabled = true;
            });

            // Handle delete user modal
            const deleteUserModal = document.getElementById('deleteUserModal');
            const deleteUserForm = document.getElementById('deleteUserForm');
            const deleteUserNameInput = document.getElementById('deleteUserName');
            const deleteBtn = document.getElementById('deleteBtn');

            deleteUserModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const userId = button.getAttribute('data-user-id');
                const userName = button.getAttribute('data-user-name');

                deleteUserNameInput.value = userName;
                deleteUserForm.action = `/admin/user/${userId}`;
            });

            // Reset form when delete modal is hidden
            deleteUserModal.addEventListener('hidden.bs.modal', function () {
                deleteUserForm.reset();
            });
        });
    </script>
@endpush
