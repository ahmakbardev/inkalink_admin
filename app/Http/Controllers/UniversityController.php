<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UniversityController extends Controller
{
    public function index()
    {
        $universities = University::all();
        return view('contents.universities.index', compact('universities'));
    }

    public function create()
    {
        return view('contents.universities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_universitas' => 'required|string|max:255',
            'gambar_rnm.*' => 'nullable|image',
            'nama_jurusan.*' => 'required|string|max:255',
            'nilai_rnm.*' => 'required|integer',
            'url_info_pendaftaran.*' => 'nullable|url',
            'url_info_passinggrade.*' => 'nullable|url',
            'url_biaya_pendidikan.*' => 'nullable|url',
        ]);

        foreach ($request->nama_jurusan as $index => $nama_jurusan) {
            $data = [
                'nama_universitas' => $request->nama_universitas,
                'nama_jurusan' => $nama_jurusan,
                'nilai_rnm' => $request->nilai_rnm[$index],
                'url_info_pendaftaran' => $request->url_info_pendaftaran[$index] ?? null,
                'url_info_passinggrade' => $request->url_info_passinggrade[$index] ?? null,
                'url_biaya_pendidikan' => $request->url_biaya_pendidikan[$index] ?? null,
            ];

            if ($request->hasFile('gambar_rnm.' . $index)) {
                $data['gambar_rnm'] = $request->file('gambar_rnm.' . $index)->store('public/universities');
            }

            University::create($data);
        }

        return redirect()->route('universities.index')->with('success', 'Data universitas berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $universities = University::where('nama_universitas', University::find($id)->nama_universitas)->get();
        return view('contents.universities.edit', compact('universities'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_universitas' => 'required|string|max:255',
            'nama_jurusan' => 'required|array',
            'nilai_rnm' => 'required|array',
            'nama_jurusan.*' => 'required|string|max:255',
            'nilai_rnm.*' => 'required|integer',
            'gambar_rnm.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url_info_pendaftaran.*' => 'nullable|url',
            'url_info_passinggrade.*' => 'nullable|url',
            'url_biaya_pendidikan.*' => 'nullable|url',
        ]);

        $university = University::findOrFail($id);

        // Update all universities with the same name
        University::where('nama_universitas', $university->nama_universitas)
            ->update(['nama_universitas' => $request->nama_universitas]);

        // Delete removed university data
        if ($request->filled('deleted_universities')) {
            $deletedIds = json_decode($request->deleted_universities, true);
            University::destroy($deletedIds);
        }

        // Update or create new university data
        foreach ($request->nama_jurusan as $index => $nama_jurusan) {
            $universityData = [
                'nama_jurusan' => $nama_jurusan,
                'nilai_rnm' => $request->nilai_rnm[$index],
                'url_info_pendaftaran' => $request->url_info_pendaftaran[$index] ?? null,
                'url_info_passinggrade' => $request->url_info_passinggrade[$index] ?? null,
                'url_biaya_pendidikan' => $request->url_biaya_pendidikan[$index] ?? null,
            ];

            if ($request->hasFile('gambar_rnm.' . $index)) {
                $imagePath = $request->file('gambar_rnm.' . $index)->store('gambar_rnm', 'public');
                $universityData['gambar_rnm'] = $imagePath;
            }

            // Update existing or create new
            if (isset($request->university_ids[$index])) {
                University::where('id', $request->university_ids[$index])->update($universityData);
            } else {
                $university->universities()->create($universityData);
            }
        }

        return redirect()->route('universities.index')->with('success', 'Universitas berhasil diperbarui.');
    }



    public function destroy($id)
    {
        $university = University::findOrFail($id);
        $university->delete();

        return redirect()->route('universities.index')->with('success', 'Rekomendasi universitas berhasil dihapus.');
    }
}
