@extends('layout.layout')

@section('title', 'Data Jurusan')

@section('content')
    <div class="container-fluid px-0">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <h1 class="text-dark mb-1">Data Jurusan</h1>
                <p class="text-muted mb-0">Kelola data jurusan.</p>
            </div>
            <a href="{{ route('jurusan.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Jurusan
            </a>
        </div>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <form action="{{ route('jurusan.index') }}" method="GET" class="row g-3 align-items-end">
                    <div class="col-12 col-lg-8">
                        <label for="search" class="form-label">Cari Data</label>
                        <input
                            type="text"
                            class="form-control"
                            id="search"
                            name="search"
                            value="{{ $search }}"
                            placeholder="Cari ID jurusan, nama jurusan, atau akreditasi"
                        >
                    </div>
                    <div class="col-12 col-md-4 col-lg-2">
                        <label for="per_page" class="form-label">Tampil</label>
                        <select class="form-select" id="per_page" name="per_page">
                            @foreach ($allowedPerPage as $option)
                                <option value="{{ $option }}" @selected($perPage === $option)>{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-lg-2 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-magnifying-glass me-1"></i> Cari
                        </button>
                        @if ($search !== '' || $perPage !== 10)
                            <a href="{{ route('jurusan.index') }}" class="btn btn-light border">Reset</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4 py-3">No</th>
                                <th class="py-3">ID Jurusan</th>
                                <th class="py-3">Nama Jurusan</th>
                                <th class="py-3">Akreditasi</th>
                                <th class="py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jurusans as $jurusan)
                                <tr>
                                    <td class="px-4">{{ $jurusans->firstItem() + $loop->index }}</td>
                                    <td>{{ $jurusan->id_jurusan }}</td>
                                    <td>{{ $jurusan->nama_jurusan }}</td>
                                    <td>
                                        <span class="badge text-bg-success">{{ $jurusan->akreditasi }}</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2 flex-wrap">
                                            <a href="{{ route('jurusan.edit', $jurusan) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen-to-square me-1"></i> Edit
                                            </a>
                                            <form action="{{ route('jurusan.destroy', $jurusan) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data jurusan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">Belum ada data jurusan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if ($jurusans->hasPages())
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mt-4">
                <p class="text-muted mb-0">
                    Menampilkan {{ $jurusans->firstItem() }} sampai {{ $jurusans->lastItem() }} dari {{ $jurusans->total() }} data
                </p>
                <div class="app-pagination">
                    {{ $jurusans->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @elseif ($jurusans->count() > 0)
            <p class="text-muted mt-4 mb-0">
                Menampilkan {{ $jurusans->count() }} data jurusan.
            </p>
        @endif
    </div>
@endsection
