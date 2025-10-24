<div>
    <div class="page-body">
        <div class="container-xl">
            @include('partials._breadcrumb', [
                'items' => [
                    ['title' => 'Training', 'url' => route('training.index')],
                    ['title' => $training->name, 'url' => route('training.home', $training->id)],
                    ['title' => 'Members', 'url' => route('training.members.index', $training->id)],
                ],
            ])

            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @php session()->forget('success'); @endphp {{-- Hapus setelah ditampilkan --}}
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @php session()->forget('error'); @endphp {{-- Hapus setelah ditampilkan --}}
            @endif

            <div class="card mb-3">
                <div class="card-body">
                    <div
                        class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center">
                        <div class="mb-3 mb-sm-0">
                            <h2 class="card-title">👥 Daftar Peserta</h2>
                            <p class="text-muted mb-0">Berikut adalah peserta yang terdaftar dalam pelatihan
                                <strong>{{ $training->name }}</strong>.
                            </p>
                        </div>
                        <div class="d-flex flex-column flex-sm-row gap-2">
                            <a href="{{ route('training.member.add.form', $training->id) }}" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-user-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    <path d="M16 19h6" />
                                    <path d="M19 16v6" />
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                                </svg>
                                Add Member
                            </a>

                            <a href="{{ route('training.member.create', $training->id) }}" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-user-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    <path d="M16 19h6" />
                                    <path d="M19 16v6" />
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                                </svg>
                                Add User + member
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th class="d-none d-sm-table-cell">Instansi</th>
                                    <th class="d-none d-md-table-cell">Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($training->members as $index => $member)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $member->user->name }}</td>
                                        <td class="d-none d-sm-table-cell">{{ $member->user->instansi ?? 'N/A' }}</td>
                                        <td class="d-none d-md-table-cell">{{ $member->user->email }}</td>
                                        <td>
                                            <div class="d-flex flex-column flex-sm-row gap-1">
                                                <button wire:click="deleteMember({{ $member->id }})"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Anda yakin ingin menghapus member ini?')">Delete</button>
                                                <button wire:click="graduateMemberAction({{ $member->id }})"
                                                    class="btn btn-sm btn-success"
                                                    onclick="return confirm('Yakin ingin menandai peserta ini sebagai lulus?')">Graduate</button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Belum ada peserta terdaftar.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title">🎓 Daftar Peserta Lulus</h2>
                    <p class="text-muted">Berikut adalah peserta yang sudah lulus dari pelatihan
                        <strong>{{ $training->name }}</strong>.
                    </p>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Sertifikat</th>
                                    <th class="d-none d-md-table-cell">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($graduateMember as $index => $gMember)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $gMember->user->name }}</td>
                                        <td>
                                            <a href="{{ $gMember->user->certificates->first()?->file_path ? asset('storage/' . $gMember->user->certificates->first()->file_path) : '#' }}"
                                                class="btn {{ $gMember->user->certificates->first()?->file_path ? 'btn-primary' : 'btn-secondary' }} btn-sm"
                                                target="_blank" rel="noopener noreferrer">
                                                {{ $gMember->user->certificates->first()?->file_path ? 'Lihat' : 'N/A' }}
                                            </a>
                                        </td>
                                        <td class="d-none d-md-table-cell">{{ $gMember->user->email }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Belum ada peserta yang lulus.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title">📥 Daftar Permintaan Bergabung</h2>
                    <p class="text-muted">Berikut adalah daftar permintaan dari user yang ingin bergabung ke pelatihan
                        <strong>{{ $training->name }}</strong>.
                    </p>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th class="d-none d-md-table-cell">Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pendingMembers as $index => $pMember)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $pMember->user->name }}</td>
                                        <td class="d-none d-md-table-cell">{{ $pMember->user->email }}</td>
                                        <td>
                                            <div class="d-flex flex-column flex-sm-row gap-1">
                                                <button wire:click="acceptMember({{ $pMember->id }})"
                                                    class="btn btn-sm btn-success w-100">Terima</button>
                                                <button wire:click="rejectMember({{ $pMember->id }})"
                                                    class="btn btn-sm btn-danger w-100">Tolak</button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Belum ada permintaan
                                            pendaftaran.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
