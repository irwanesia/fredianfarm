@extends('layouts.admin')
@section('title', isset($pengguna) ? 'Edit Pengguna' : 'Tambah Pengguna')
@section('content')
<form method="POST" action="{{ isset($pengguna) ? route('admin.pengguna.update', $pengguna) : route('admin.pengguna.store') }}">
    @csrf
    @if (isset($pengguna)) @method('PUT') @endif
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header"><h3 class="card-title">{{ isset($pengguna) ? 'Edit Pengguna' : 'Tambah Pengguna Baru' }}</h3></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label required">Nama</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $pengguna->name ?? '') }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $pengguna->email ?? '') }}" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select @error('role') is-invalid @enderror">
                            <option value="editor" @selected(old('role', $pengguna->role ?? 'editor') === 'editor')>Editor — kelola katalog & konten</option>
                            <option value="admin" @selected(old('role', $pengguna->role ?? 'editor') === 'admin')>Super Admin — akses penuh</option>
                        </select>
                        @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ isset($pengguna) ? 'Password Baru (kosongkan jika tidak diubah)' : 'Password' }}</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn text-white" style="background:var(--brand-green)">{{ isset($pengguna) ? 'Simpan Perubahan' : 'Simpan' }}</button>
                        <a href="{{ route('admin.pengguna.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
