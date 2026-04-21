@extends('layout.layout')

@section('title', 'Edit Matakuliah')

@section('content')
    <div class="container-fluid px-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="text-dark mb-1">Edit Matakuliah</h1>
                <p class="text-muted mb-0">Perbarui data matakuliah dengan ID {{ $matakuliah->id_matakuliah }}.</p>
            </div>
            <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-secondary">
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

                <form action="{{ route('matakuliah.update', $matakuliah) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-4">
                        <div class="col-12">
                            <label for="nama_matakuliah" class="form-label">Nama Matakuliah</label>
                            <input
                                type="text"
                                class="form-control form-control-lg @error('nama_matakuliah') is-invalid @enderror"
                                id="nama_matakuliah"
                                name="nama_matakuliah"
                                value="{{ old('nama_matakuliah', $matakuliah->nama_matakuliah) }}"
                                required
                            >
                            @error('nama_matakuliah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-4">
                            <label for="sks" class="form-label">SKS</label>
                            <input
                                type="number"
                                min="1"
                                class="form-control form-control-lg @error('sks') is-invalid @enderror"
                                id="sks"
                                name="sks"
                                value="{{ old('sks', $matakuliah->sks) }}"
                                required
                            >
                            @error('sks')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-8">
                            <label for="id_jurusan" class="form-label">Jurusan</label>
                            <select class="form-select form-select-lg @error('id_jurusan') is-invalid @enderror" id="id_jurusan" name="id_jurusan" required>
                                <option value="">Pilih Jurusan</option>
                                @foreach ($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id_jurusan }}" @selected((string) old('id_jurusan', $matakuliah->id_jurusan) === (string) $jurusan->id_jurusan)>
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
                            <i class="fas fa-save me-1"></i> Update
                        </button>
                        <a href="{{ route('matakuliah.index') }}" class="btn btn-light border">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
