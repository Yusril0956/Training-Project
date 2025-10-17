<div>
    <div class="page-body">
        <div class="container-xl">

            @include('partials._breadcrumb', [
                'items' => [
                    ['title' => 'Training', 'url' => route('training.index')],
                    ['title' => $training->name, 'url' => route('training.home', $training->id)],
                    ['title' => 'Members', 'url' => route('training.members', $training->id)],
                    ['title' => 'Add New Member', 'url' => '#'],
                ],
            ])

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Formulir Tambah User & Member Baru</h3>
                </div>
                <form wire:submit.prevent="addNewUser">
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label required">Name</label>
                            <input type="text" class="form-control @error('newUserName') is-invalid @enderror" wire:model="newUserName" placeholder="Masukkan nama lengkap">
                            @error('newUserName') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">NIK</label>
                            <input type="text" maxlength="6" class="form-control @error('newUserNik') is-invalid @enderror" wire:model="newUserNik" placeholder="Masukkan NIK 6 digit">
                            @error('newUserNik') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Email</label>
                            <input type="email" class="form-control @error('newUserEmail') is-invalid @enderror" wire:model="newUserEmail" placeholder="Masukkan alamat email">
                            @error('newUserEmail') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Status</label>
                            <select class="form-select @error('newUserStatus') is-invalid @enderror" wire:model="newUserStatus">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            @error('newUserStatus') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('training.members', $training->id) }}" class="btn">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <div wire:loading wire:target="addNewUser" class="spinner-border spinner-border-sm" role="status"></div>
                            Submit
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>