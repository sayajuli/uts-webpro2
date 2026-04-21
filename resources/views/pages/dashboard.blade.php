@extends('layout.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid px-0">
        <div class="mb-4">
            <h1 class="text-dark mb-1">Dashboard</h1>
            <p class="text-muted mb-0">Ringkasan akumulasi data sistem akademik.</p>
        </div>

        <div class="row g-4">
            <div class="col-12 col-md-6 col-xl-4">
                <div class="card shadow-sm border-0 h-100 dashboard-card">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <p class="text-uppercase text-muted small mb-2">Total Jurusan</p>
                                <h2 class="mb-0">{{ $totalJurusan }}</h2>
                            </div>
                            <div class="dashboard-icon bg-primary-subtle text-primary">
                                <i class="fas fa-building"></i>
                            </div>
                        </div>
                        <p class="text-muted mb-0">Jumlah seluruh data jurusan yang sudah terdaftar.</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <div class="card shadow-sm border-0 h-100 dashboard-card">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <p class="text-uppercase text-muted small mb-2">Total Mahasiswa</p>
                                <h2 class="mb-0">{{ $totalMahasiswa }}</h2>
                            </div>
                            <div class="dashboard-icon bg-success-subtle text-success">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <p class="text-muted mb-0">Jumlah seluruh data mahasiswa yang tersimpan.</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <div class="card shadow-sm border-0 h-100 dashboard-card">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <p class="text-uppercase text-muted small mb-2">Total Matakuliah</p>
                                <h2 class="mb-0">{{ $totalMatakuliah }}</h2>
                            </div>
                            <div class="dashboard-icon bg-warning-subtle text-warning">
                                <i class="fas fa-book"></i>
                            </div>
                        </div>
                        <p class="text-muted mb-0">Jumlah seluruh data matakuliah yang aktif di sistem.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
