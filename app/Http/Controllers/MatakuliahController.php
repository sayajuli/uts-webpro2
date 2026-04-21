<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\Matakuliah;

class MatakuliahController extends Controller
{
    private const ALLOWED_PER_PAGE = [10, 20, 30, 50];

    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $perPage = (int) $request->query('per_page', 10);

        if (! in_array($perPage, self::ALLOWED_PER_PAGE, true)) {
            $perPage = 10;
        }

        $matakuliahs = Matakuliah::with('jurusan')
            ->when($search !== '', function ($query) use ($search) {
                $query->where('id_matakuliah', 'like', "%{$search}%")
                    ->orWhere('nama_matakuliah', 'like', "%{$search}%")
                    ->orWhere('sks', 'like', "%{$search}%")
                    ->orWhereHas('jurusan', function ($jurusanQuery) use ($search) {
                        $jurusanQuery->where('nama_jurusan', 'like', "%{$search}%");
                    });
            })
            ->orderBy('id_matakuliah')
            ->paginate($perPage)
            ->withQueryString();

        $allowedPerPage = self::ALLOWED_PER_PAGE;

        return view('pages.matakuliah', compact('matakuliahs', 'search', 'perPage', 'allowedPerPage'));
    }

    public function create()
    {
        $jurusans = Jurusan::orderBy('nama_jurusan')->get();

        return view('pages.matakuliah-create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateMatakuliah($request);

        Matakuliah::create($validated);

        return redirect()->route('matakuliah.index')->with('success', 'Matakuliah berhasil ditambahkan');
    }

    public function show(Matakuliah $matakuliah)
    {
        return redirect()->route('matakuliah.index');
    }

    public function edit(Matakuliah $matakuliah)
    {
        $jurusans = Jurusan::orderBy('nama_jurusan')->get();

        return view('pages.matakuliah-edit', compact('matakuliah', 'jurusans'));
    }

    public function update(Request $request, Matakuliah $matakuliah)
    {
        $validated = $this->validateMatakuliah($request);

        $matakuliah->update($validated);

        return redirect()->route('matakuliah.index')->with('success', 'Matakuliah berhasil diperbarui');
    }

    public function destroy(Matakuliah $matakuliah)
    {
        $matakuliah->delete();

        return redirect()->route('matakuliah.index')->with('success', 'Matakuliah berhasil dihapus');
    }

    private function validateMatakuliah(Request $request): array
    {
        return $request->validate(
            [
                'nama_matakuliah' => ['required', 'string', 'max:255'],
                'sks' => ['required', 'integer', 'min:1'],
                'id_jurusan' => ['required', 'integer', 'exists:tb_jurusan,id_jurusan'],
            ],
            [
                'nama_matakuliah.required' => 'Nama matakuliah wajib diisi.',
                'nama_matakuliah.max' => 'Nama matakuliah maksimal 255 karakter.',
                'sks.required' => 'SKS wajib diisi.',
                'sks.integer' => 'SKS harus berupa angka.',
                'sks.min' => 'SKS minimal bernilai 1.',
                'id_jurusan.required' => 'Jurusan wajib dipilih.',
                'id_jurusan.exists' => 'Jurusan yang dipilih tidak valid.',
            ]
        );
    }
}
