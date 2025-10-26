<div>
    <div class="page-body">
        <div class="container-xl">

            @include('partials._breadcrumb', [
                'items' => [
                    ['title' => 'Training', 'url' => route('training.index')],
                    ['title' => $training->name, 'url' => route('training.home', $training->id)],
                    ['title' => 'Setting', 'url' => route('training.settings', $training->id)],
                ],
            ])

            <!-- Header -->
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title">Pengaturan Training</h2>
                    <p class="text-muted">Atur informasi dan status pelatihan <strong>{{ $training->name }}</strong>.</p>

                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Form Pengaturan Umum -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Informasi Umum</h3>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="updateSettings">
                        <div class="mb-3">
                            <label class="form-label">Judul Pelatihan</label>
                            <input type="text" wire:model="name" class="form-control" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea wire:model="description" class="form-control" rows="4"></textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select wire:model="status" class="form-select">
                                <option value="open">Open</option>
                                <option value="close">Close</option>
                            </select>
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Instruktur</label>
                            <select wire:model="instructor_id" class="form-select">
                                <option value="">Pilih Instruktur</option>
                                @foreach ($instructors as $instructor)
                                    <option value="{{ $instructor->id }}"
                                        {{ $instructor->id == $instructor_id ? 'selected' : '' }}>
                                        {{ $instructor->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('instructor_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Aksi Tambahan -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Aksi Tambahan</h3>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <a href="{{ route('training.members.index', $training->id) }}"
                                class="btn btn-outline-primary w-100">Kelola Peserta</a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('training.tasks', $training->id) }}"
                                class="btn btn-outline-warning w-100">Kelola Tugas</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
