@extends('layout.layout')

@section('title', 'Tambah Mahasiswa')

@section('content')
    <div class="container-fluid px-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="text-dark mb-1">Tambah Mahasiswa</h1>
                <p class="text-muted mb-0">Masukkan data mahasiswa baru.</p>
            </div>
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4 p-lg-5">
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <strong>Data belum bisa disimpan.</strong>
                        <ul class="mb-0 mt-2 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('mahasiswa.store') }}" method="POST">
                    @csrf
                    <div class="row g-4">
                        <div class="col-12 col-lg-6">
                            <label for="nim" class="form-label">NIM</label>
                            <input
                                type="text"
                                class="form-control form-control-lg @error('nim') is-invalid @enderror"
                                id="nim"
                                name="nim"
                                value="{{ old('nim') }}"
                                placeholder="Contoh: 230001"
                                required
                            >
                            @error('nim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="nama" class="form-label">Nama Mahasiswa</label>
                            <input
                                type="text"
                                class="form-control form-control-lg @error('nama') is-invalid @enderror"
                                id="nama"
                                name="nama"
                                value="{{ old('nama') }}"
                                placeholder="Contoh: Sahrul Juli"
                                required
                            >
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="id_jurusan" class="form-label">Jurusan</label>
                            <select class="form-select form-select-lg @error('id_jurusan') is-invalid @enderror" id="id_jurusan" name="id_jurusan" required>
                                <option value="">Pilih Jurusan</option>
                                @foreach ($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id_jurusan }}" @selected((string) old('id_jurusan') === (string) $jurusan->id_jurusan)>
                                        {{ $jurusan->nama_jurusan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_jurusan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Simpan
                        </button>
                        <a href="{{ route('mahasiswa.index') }}" class="btn btn-light border">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
