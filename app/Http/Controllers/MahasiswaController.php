<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    private const ALLOWED_PER_PAGE = [10, 20, 30, 50];

    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $perPage = (int) $request->query('per_page', 10);

        if (! in_array($perPage, self::ALLOWED_PER_PAGE, true)) {
            $perPage = 10;
        }

        $mahasiswas = Mahasiswa::with('jurusan')
            ->when($search !== '', function ($query) use ($search) {
                $query->where('id_mahasiswa', 'like', "%{$search}%")
                    ->orWhere('nim', 'like', "%{$search}%")
                    ->orWhere('nama', 'like', "%{$search}%")
                    ->orWhereHas('jurusan', function ($jurusanQuery) use ($search) {
                        $jurusanQuery->where('nama_jurusan', 'like', "%{$search}%");
                    });
            })
            ->orderBy('id_mahasiswa')
            ->paginate($perPage)
            ->withQueryString();

        $allowedPerPage = self::ALLOWED_PER_PAGE;

        return view('pages.mahasiswa', compact('mahasiswas', 'search', 'perPage', 'allowedPerPage'));
    }

    public function create()
    {
        $jurusans = Jurusan::orderBy('nama_jurusan')->get();

        return view('pages.mahasiswa-create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateMahasiswa($request);

        Mahasiswa::create($validated);

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    public function show(Mahasiswa $mahasiswa)
    {
        return redirect()->route('mahasiswa.index');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $jurusans = Jurusan::orderBy('nama_jurusan')->get();

        return view('pages.mahasiswa-edit', compact('mahasiswa', 'jurusans'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validated = $this->validateMahasiswa($request);

        $mahasiswa->update($validated);

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diperbarui');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus');
    }

    private function validateMahasiswa(Request $request): array
    {
        return $request->validate(
            [
                'nim' => ['required', 'string', 'max:255'],
                'nama' => ['required', 'string', 'max:255'],
                'id_jurusan' => ['required', 'integer', 'exists:tb_jurusan,id_jurusan'],
            ],
            [
                'nim.required' => 'NIM wajib diisi.',
                'nim.max' => 'NIM maksimal 255 karakter.',
                'nama.required' => 'Nama mahasiswa wajib diisi.',
                'nama.max' => 'Nama mahasiswa maksimal 255 karakter.',
                'id_jurusan.required' => 'Jurusan wajib dipilih.',
                'id_jurusan.exists' => 'Jurusan yang dipilih tidak valid.',
            ]
        );
    }
}
