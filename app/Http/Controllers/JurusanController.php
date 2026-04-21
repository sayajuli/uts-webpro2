<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;
use Illuminate\Validation\Rule;

class JurusanController extends Controller
{
    private const AKREDITASI_OPTIONS = ['Unggul', 'Baik Sekali', 'Baik'];

    // Tampilkan semua jurusan
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $perPage = (int) $request->query('per_page', 10);
        $allowedPerPage = [10, 20, 30, 50];

        if (! in_array($perPage, $allowedPerPage, true)) {
            $perPage = 10;
        }

        $jurusans = Jurusan::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where('id_jurusan', 'like', "%{$search}%")
                    ->orWhere('nama_jurusan', 'like', "%{$search}%")
                    ->orWhere('akreditasi', 'like', "%{$search}%");
            })
            ->orderBy('id_jurusan')
            ->paginate($perPage)
            ->withQueryString();

        return view('pages.jurusan', compact('jurusans', 'search', 'perPage', 'allowedPerPage'));
    }

    // Tampilkan form create
    public function create()
    {
        $akreditasiOptions = self::AKREDITASI_OPTIONS;

        return view('pages.jurusan-create', compact('akreditasiOptions'));
    }

    // Simpan data jurusan baru
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'nama_jurusan' => ['required', 'string', 'max:100'],
                'akreditasi' => ['required', Rule::in(self::AKREDITASI_OPTIONS)],
            ],
            [
                'nama_jurusan.required' => 'Nama jurusan wajib diisi.',
                'nama_jurusan.max' => 'Nama jurusan maksimal 100 karakter.',
                'akreditasi.required' => 'Akreditasi wajib dipilih.',
                'akreditasi.in' => 'Akreditasi harus sesuai pilihan yang tersedia.',
            ]
        );

        Jurusan::create($validated);

        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil ditambahkan');
    }

    // Tampilkan detail jurusan
    public function show(Jurusan $jurusan)
    {
        return redirect()->route('jurusan.index');
    }

    // Tampilkan form edit
    public function edit(Jurusan $jurusan)
    {
        $akreditasiOptions = self::AKREDITASI_OPTIONS;

        return view('pages.jurusan-edit', compact('jurusan', 'akreditasiOptions'));
    }

    // Update data jurusan
    public function update(Request $request, Jurusan $jurusan)
    {
        $validated = $request->validate(
            [
                'nama_jurusan' => ['required', 'string', 'max:100'],
                'akreditasi' => ['required', Rule::in(self::AKREDITASI_OPTIONS)],
            ],
            [
                'nama_jurusan.required' => 'Nama jurusan wajib diisi.',
                'nama_jurusan.max' => 'Nama jurusan maksimal 100 karakter.',
                'akreditasi.required' => 'Akreditasi wajib dipilih.',
                'akreditasi.in' => 'Akreditasi harus sesuai pilihan yang tersedia.',
            ]
        );

        $jurusan->update($validated);

        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil diperbarui');
    }

    // Hapus data jurusan
    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();

        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil dihapus');
    }
}
