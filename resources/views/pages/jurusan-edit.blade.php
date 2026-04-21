@extends('layout.layout')

@section('title', 'Edit Jurusan')

@section('content')
    <div class="container-fluid px-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="text-dark mb-1">Edit Jurusan</h1>
                <p class="text-muted mb-0">Perbarui data jurusan dengan ID {{ $jurusan->id_jurusan }}.</p>
            </div>
            <a href="{{ route('jurusan.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4 p-lg-5">
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <strong>Data belum bisa diperbarui.</strong>
                        <ul class="mb-0 mt-2 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('jurusan.update', $jurusan) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-4">
                        <div class="col-12">
                            <label for="nama_jurusan" class="form-label">Nama Jurusan</label>
                            <input
                                type="text"
                                class="form-control form-control-lg @error('nama_jurusan') is-invalid @enderror"
                                id="nama_jurusan"
                                name="nama_jurusan"
                                value="{{ old('nama_jurusan', $jurusan->nama_jurusan) }}"
                                required
                            >
                            @error('nama_jurusan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="akreditasi" class="form-label">Akreditasi</label>
                            <select
                                class="form-select form-select-lg @error('akreditasi') is-invalid @enderror"
                                id="akreditasi"
                                name="akreditasi"
                                required
                            >
                                <option value="">Pilih akreditasi</option>
                                @foreach ($akreditasiOptions as $akreditasi)
                                    <option value="{{ $akreditasi }}" @selected(old('akreditasi', $jurusan->akreditasi) === $akreditasi)>
                                        {{ $akreditasi }}
                                    </option>
                                @endforeach
                            </select>
                            @error('akreditasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update
                        </button>
                        <a href="{{ route('jurusan.index') }}" class="btn btn-light border">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
